/* ==========================================
   JB GARAGE - Frontend Client
   PHP + MySQL API
========================================== */

const JB = (() => {
  // KONFIGURASI
  const ALLOWED = ["image/jpeg", "image/png", "image/webp"];

  const MAX_FILE = 5 * 1024 * 1024;
  const MAX_IMAGES = 4;

  // FUNGSI BANTU
  const esc = (s) => {
    return String(s ?? "").replace(
      /[&<>"']/g,
      (c) =>
        ({
          "&": "&amp;",
          "<": "&lt;",
          ">": "&gt;",
          '"': "&quot;",
          "'": "&#39;",
        })[c],
    );
  };

  const rupiah = (n) => {
    return "Rp " + new Intl.NumberFormat("id-ID").format(Number(n) || 0);
  };

  // REQUEST API
  async function request(url, options = {}) {
    const r = await fetch(url, {
      credentials: "same-origin",
      ...options,
    });

    let d;

    try {
      d = await r.json();
    } catch {
      throw new Error(
        "Respons server tidak valid. Pastikan Apache dan PHP berjalan.",
      );
    }

    if (!r.ok || d.success === false) {
      throw new Error(d.message || "Permintaan gagal.");
    }

    return d;
  }

  const ready = Promise.resolve();

  // AUTENTIKASI
  async function currentUser() {
    try {
      return (await request("api/me.php")).user;
    } catch {
      return null;
    }
  }

  async function register(data) {
    try {
      return await request("api/register.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      });
    } catch (e) {
      return {
        success: false,
        message: e.message,
      };
    }
  }

  async function login(email, password, remember) {
    try {
      return await request("api/login.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          email,
          password,
          remember,
        }),
      });
    } catch (e) {
      return {
        success: false,
        message: e.message,
      };
    }
  }

  async function logout() {
    try {
      await request("api/logout.php", {
        method: "POST",
      });
    } finally {
      location.href = "index.php";
    }
  }

  async function requireLogin() {
    const u = await currentUser();

    if (!u) {
      location.replace(
        "login.html?next=" +
          encodeURIComponent(location.pathname.split("/").pop()),
      );

      return null;
    }

    return u;
  }

  // DATA LISTING
  async function listings(mine = false) {
    const url = "api/listings.php" + (mine ? "?mine=1" : "");

    const d = await request(url);

    return d.listings || [];
  }

  // PAGINATION
  function paginate(items, page, per) {
    const pages = Math.max(1, Math.ceil(items.length / per));

    page = Math.min(Math.max(1, page), pages);

    return {
      page,
      pages,
      total: items.length,

      from: items.length ? (page - 1) * per + 1 : 0,

      to: Math.min(page * per, items.length),

      slice: items.slice((page - 1) * per, page * per),
    };
  }

  function renderPager(el, pg, onChange) {
    if (!el) return;

    if (pg.pages <= 1) {
      el.innerHTML = "";
      return;
    }

    const nums = [...new Set([1, pg.pages, pg.page - 1, pg.page, pg.page + 1])]
      .filter((n) => n >= 1 && n <= pg.pages)
      .sort((a, b) => a - b);

    let html = `
            <ul class="pagination justify-content-center mb-0">

                <li class="page-item ${pg.page === 1 ? "disabled" : ""}">
                    <button class="page-link"
                        data-p="${pg.page - 1}">
                        &laquo;
                    </button>
                </li>
        `;

    let prev = 0;

    for (const n of nums) {
      if (n - prev > 1) {
        html += `
                    <li class="page-item disabled">
                        <span class="page-link">…</span>
                    </li>
                `;
      }

      html += `
                <li class="page-item ${n === pg.page ? "active" : ""}">
                    <button class="page-link"
                        data-p="${n}">
                        ${n}
                    </button>
                </li>
            `;

      prev = n;
    }

    html += `
                <li class="page-item ${pg.page === pg.pages ? "disabled" : ""}">
                    <button class="page-link"
                        data-p="${pg.page + 1}">
                        &raquo;
                    </button>
                </li>

            </ul>
        `;

    el.innerHTML = html;

    el.querySelectorAll("button[data-p]").forEach((button) => {
      button.addEventListener("click", () => {
        onChange(Number(button.dataset.p));
      });
    });
  }

  // KARTU KENDARAAN
  function cardHTML(l) {
    const img = l.images?.[0]
      ? `
                <img
                    src="${esc(l.images[0])}"
                    class="listing-img"
                    alt="${esc(l.title)}"
                    loading="lazy"
                >
            `
      : `
                <div class="listing-img ph">
                    ${l.type === "mobil" ? "🚗" : "🏍"}
                    <small>Foto belum tersedia</small>
                </div>
            `;

    const badge =
      {
        Aktif: "success",
        Review: "warning",
        Terjual: "secondary",
      }[l.status] || "secondary";

    return `
            <div
                class="card listing-card h-100"
                role="button"
                data-id="${esc(l.id)}"
            >
                ${img}

                <div class="card-body">

                    <div class="d-flex justify-content-between
                        align-items-start gap-1 mb-1">

                        <h5 class="card-title h6 mb-0">
                            ${esc(l.title)}

                            <span class="text-secondary small fw-normal">
                                ${esc(l.year)}
                            </span>
                        </h5>

                        <span class="badge text-bg-${badge}">
                            ${esc(l.status)}
                        </span>

                    </div>

                    <div class="fw-bold">
                        ${rupiah(l.price)}
                    </div>

                    <div class="small text-secondary mt-1">
                        📍 ${esc(l.city)} · 👁 ${l.views}
                    </div>

                </div>
            </div>
        `;
  }

  // NAVIGASI AKUN
  function renderAuthNav() {
    const el = document.getElementById("authNav");

    if (!el) return;

    currentUser().then((u) => {
      if (!u) {
        el.innerHTML = `
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm w-100"
                            href="login.html">
                            Masuk
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-light btn-sm w-100
                            text-danger fw-semibold"
                            href="register.html">
                            Daftar
                        </a>
                    </li>
                `;

        return;
      }

      el.innerHTML = `
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle
                        d-flex align-items-center gap-2"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown">

                        <span class="avatar">
                            ${esc(u.name.charAt(0).toUpperCase())}
                        </span>

                        <span>
                            ${esc(u.name.split(" ")[0])}
                        </span>

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <h6 class="dropdown-header">
                                ${esc(u.email)}
                                <br>

                                <span class="badge text-bg-${
                                  u.role === "penjual" ? "warning" : "info"
                                }">
                                    ${esc(u.role)}
                                </span>
                            </h6>
                        </li>

                        ${
                          ["penjual", "admin"].includes(u.role)
                            ? `
                                    <li>
                                        <a class="dropdown-item"
                                            href="jual.html">
                                            ➕ Pasang Iklan
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item"
                                            href="jual.html#iklan-saya">
                                            📋 Iklan Saya
                                        </a>
                                    </li>
                                `
                            : ""
                        }

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <button
                                class="dropdown-item text-danger"
                                id="btnLogout"
                                type="button">
                                🚪 Keluar
                            </button>
                        </li>

                    </ul>
                </li>
            `;

      document.getElementById("btnLogout")?.addEventListener("click", logout);
    });
  }

  // KOMPRESI FOTO
  function compressImage(file, maxSide = 1200, quality = 0.82) {
    return new Promise((resolve, reject) => {
      const fr = new FileReader();

      fr.onerror = () => {
        reject(Error("Gagal membaca foto."));
      };

      fr.onload = () => {
        const im = new Image();

        im.onerror = () => {
          reject(Error("File bukan gambar valid."));
        };

        im.onload = () => {
          const r = Math.min(1, maxSide / Math.max(im.width, im.height));

          const c = document.createElement("canvas");

          c.width = Math.round(im.width * r);
          c.height = Math.round(im.height * r);

          c.getContext("2d").drawImage(im, 0, 0, c.width, c.height);

          c.toBlob(
            (b) => {
              if (b) {
                resolve(b);
              } else {
                reject(Error("Gagal memproses foto."));
              }
            },
            "image/jpeg",
            quality,
          );
        };

        im.src = fr.result;
      };

      fr.readAsDataURL(file);
    });
  }

  // INISIALISASI
  document.addEventListener("DOMContentLoaded", renderAuthNav);

  // FUNGSI YANG BISA DIAKSES FILE LAIN
  return {
    ready,
    esc,
    rupiah,
    currentUser,
    register,
    login,
    logout,
    requireLogin,
    listings,
    paginate,
    renderPager,
    cardHTML,
    compressImage,
    ALLOWED,
    MAX_FILE,
    MAX_IMAGES,
    request,
  };
})();
