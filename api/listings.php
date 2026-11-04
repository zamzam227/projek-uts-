<?php

// Memanggil bootstrap
require __DIR__ . '/bootstrap.php';


// Mengambil HTTP request method
$method = $_SERVER['REQUEST_METHOD'];


// ==========================================
// GET: Mengambil Data Iklan
// ==========================================

if ($method === 'GET') {

    // Mengambil iklan milik user yang sedang login
    if (isset($_GET['mine'])) {

        $u = require_user();

        $q = $pdo->prepare("
            SELECT id
            FROM listings
            WHERE user_id = ?
            ORDER BY created_at DESC
        ");

        $q->execute([$u['id']]);

        $ids = $q->fetchAll(PDO::FETCH_COLUMN);

        $items = [];

        foreach ($ids as $id) {
            $items[] = listing_row($pdo, $id);
        }

        respond([
            'success' => true,
            'listings' => $items
        ]);
    }


    // Mengambil semua iklan yang masih aktif
    $q = $pdo->query("
        SELECT id
        FROM listings
        WHERE status = 'Aktif'
        ORDER BY created_at DESC
    ");

    $items = [];

    foreach ($q->fetchAll(PDO::FETCH_COLUMN) as $id) {
        $items[] = listing_row($pdo, $id);
    }

    respond([
        'success' => true,
        'listings' => $items
    ]);
}


// ==========================================
// POST: Menambahkan Iklan Baru
// ==========================================

if ($method === 'POST') {

    $u = require_seller();


    // Mengambil data dari form
    $title = trim($_POST['title'] ?? '');
    $type = $_POST['type'] ?? '';
    $year = (int) ($_POST['year'] ?? 0);
    $price = (float) ($_POST['price'] ?? 0);
    $city = trim($_POST['city'] ?? '');
    $desc = trim($_POST['desc'] ?? '');


    // Validasi data iklan
    if (
        $title === '' ||
        mb_strlen($title) > 60 ||
        !in_array($type, ['motor', 'mobil'], true) ||
        $year < 1990 ||
        $year > (int) date('Y') + 1 ||
        $price < 500000 ||
        $city === '' ||
        mb_strlen($city) > 40 ||
        $desc === '' ||
        mb_strlen($desc) > 500
    ) {
        respond([
            'success' => false,
            'message' => 'Data iklan tidak valid.'
        ], 422);
    }


    // Validasi jumlah foto
    if (
        empty($_FILES['images']) ||
        !is_array($_FILES['images']['name']) ||
        count(array_filter($_FILES['images']['name'])) < 1 ||
        count(array_filter($_FILES['images']['name'])) > 4
    ) {
        respond([
            'success' => false,
            'message' => 'Unggah 1 sampai 4 foto.'
        ], 422);
    }


    // Memulai transaksi database
    $pdo->beginTransaction();

    $saved = [];

    try {

        // Menyimpan data iklan
        $q = $pdo->prepare("
            INSERT INTO listings (
                user_id,
                judul,
                jenis,
                tahun,
                harga,
                kota,
                deskripsi,
                status
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, 'Aktif')
        ");

        $q->execute([
            $u['id'],
            $title,
            $type,
            $year,
            $price,
            $city,
            $desc
        ]);

        $id = (int) $pdo->lastInsertId();


        // Menyiapkan folder upload
        $dir = __DIR__ . '/../uploads';

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }


        // Format gambar yang diizinkan
        $allowed = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp'
        ];


        // Proses upload setiap foto
        foreach ($_FILES['images']['tmp_name'] as $i => $tmp) {

            // Memeriksa error upload
            if ($_FILES['images']['error'][$i] !== UPLOAD_ERR_OK) {
                throw new Exception(
                    'Gagal mengunggah salah satu foto.'
                );
            }


            // Memeriksa ukuran foto
            if ($_FILES['images']['size'][$i] > 5 * 1024 * 1024) {
                throw new Exception(
                    'Ukuran foto maksimal 5 MB.'
                );
            }


            // Memeriksa format gambar
            $mime = (new finfo(FILEINFO_MIME_TYPE))->file($tmp);

            if (!isset($allowed[$mime])) {
                throw new Exception(
                    'Format foto harus JPG, PNG, atau WEBP.'
                );
            }


            // Membuat nama file unik
            $filename = 'listing_' . $id . '_'
                . bin2hex(random_bytes(8))
                . '.' . $allowed[$mime];


            // Memindahkan foto ke folder uploads
            if (!move_uploaded_file($tmp, $dir . '/' . $filename)) {
                throw new Exception(
                    'Tidak dapat menyimpan foto.'
                );
            }


            // Menyimpan lokasi foto
            $path = 'uploads/' . $filename;

            $saved[] = $dir . '/' . $filename;


            // Menyimpan lokasi foto ke database
            $im = $pdo->prepare("
                INSERT INTO listing_images (
                    listing_id,
                    image_path
                )
                VALUES (?, ?)
            ");

            $im->execute([
                $id,
                $path
            ]);
        }


        // Menyelesaikan transaksi
        $pdo->commit();

        respond([
            'success' => true,
            'message' => 'Iklan berhasil dipublikasikan.',
            'listing' => listing_row($pdo, $id)
        ]);


    } catch (Throwable $e) {

        // Membatalkan transaksi jika terjadi error
        $pdo->rollBack();


        // Menghapus foto yang sudah terunggah
        foreach ($saved as $f) {

            if (is_file($f)) {
                unlink($f);
            }
        }


        // Mengirim pesan error
        respond([
            'success' => false,
            'message' => $e instanceof Exception
                ? $e->getMessage()
                : 'Gagal menyimpan iklan.'
        ], 400);
    }
}


// ==========================================
// PATCH: Mengubah Status Iklan
// ==========================================

if ($method === 'PATCH') {

    $u = require_seller();

    $d = body_json();

    $id = (int) ($d['id'] ?? 0);


    // Mengambil data pemilik dan status iklan
    $q = $pdo->prepare("
        SELECT user_id, status
        FROM listings
        WHERE id = ?
    ");

    $q->execute([$id]);

    $l = $q->fetch();


    // Memeriksa kepemilikan iklan
    if (
        !$l ||
        (
            $l['user_id'] != $u['id'] &&
            $u['role'] !== 'admin'
        )
    ) {
        respond([
            'success' => false,
            'message' => 'Iklan tidak ditemukan.'
        ], 404);
    }


    // Mengubah status iklan
    $status = $l['status'] === 'Terjual'
        ? 'Aktif'
        : 'Terjual';


    $q = $pdo->prepare("
        UPDATE listings
        SET status = ?
        WHERE id = ?
    ");

    $q->execute([
        $status,
        $id
    ]);


    // Mengirim status terbaru
    respond([
        'success' => true,
        'status' => $status
    ]);
}


// ==========================================
// DELETE: Menghapus Iklan
// ==========================================

if ($method === 'DELETE') {

    $u = require_seller();

    $d = body_json();

    $id = (int) ($d['id'] ?? 0);


    // Mengambil pemilik iklan
    $q = $pdo->prepare("
        SELECT user_id
        FROM listings
        WHERE id = ?
    ");

    $q->execute([$id]);

    $owner = $q->fetchColumn();


    // Memeriksa kepemilikan iklan
    if (
        !$owner ||
        (
            $owner != $u['id'] &&
            $u['role'] !== 'admin'
        )
    ) {
        respond([
            'success' => false,
            'message' => 'Iklan tidak ditemukan.'
        ], 404);
    }


    // Mengambil lokasi foto iklan
    $q = $pdo->prepare("
        SELECT image_path
        FROM listing_images
        WHERE listing_id = ?
    ");

    $q->execute([$id]);


    // Menghapus file foto dari folder uploads
    foreach ($q->fetchAll(PDO::FETCH_COLUMN) as $p) {

        $f = realpath(__DIR__ . '/../' . $p);

        $base = realpath(__DIR__ . '/../uploads');

        if (
            $f &&
            $base &&
            str_starts_with(
                $f,
                $base . DIRECTORY_SEPARATOR
            )
        ) {
            @unlink($f);
        }
    }


    // Menghapus data iklan dari database
    $q = $pdo->prepare("
        DELETE FROM listings
        WHERE id = ?
    ");

    $q->execute([$id]);


    // Mengirim response berhasil
    respond([
        'success' => true,
        'message' => 'Iklan dihapus.'
    ]);
}


// ==========================================
// Response Jika Method Tidak Diizinkan
// ==========================================

respond([
    'success' => false,
    'message' => 'Method tidak diizinkan.'
], 405);