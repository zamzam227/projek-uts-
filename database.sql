CREATE DATABASE IF NOT EXISTS jb_garage CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE jb_garage;
CREATE TABLE IF NOT EXISTS users (
 id INT AUTO_INCREMENT PRIMARY KEY, nama_lengkap VARCHAR(60) NOT NULL, email VARCHAR(100) NOT NULL UNIQUE,
 password VARCHAR(255) NOT NULL, role ENUM('pembeli','penjual','admin') NOT NULL DEFAULT 'pembeli',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS listings (
 id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL, judul VARCHAR(60) NOT NULL, jenis ENUM('motor','mobil') NOT NULL,
 tahun YEAR NOT NULL, harga DECIMAL(15,2) NOT NULL, kota VARCHAR(40) NOT NULL, deskripsi VARCHAR(500) NOT NULL,
 status ENUM('Aktif','Review','Terjual') NOT NULL DEFAULT 'Review', views INT UNSIGNED NOT NULL DEFAULT 0,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 INDEX idx_listing_filter(jenis,status,harga), INDEX idx_listing_city(kota), INDEX idx_listing_user(user_id),
 CONSTRAINT fk_listings_user FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS listing_images (
 id INT AUTO_INCREMENT PRIMARY KEY, listing_id INT NOT NULL, image_path VARCHAR(255) NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, CONSTRAINT fk_images_listing FOREIGN KEY(listing_id) REFERENCES listings(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS contact_messages (
 id INT AUTO_INCREMENT PRIMARY KEY, nama VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, subjek VARCHAR(150), pesan TEXT NOT NULL,
 status ENUM('Belum Dibaca','Sudah Dibaca') DEFAULT 'Belum Dibaca', created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS user_sessions (
 id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL, session_token VARCHAR(255) NOT NULL UNIQUE, expires_at DATETIME NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, CONSTRAINT fk_sessions_user FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS listing_views (
 id INT AUTO_INCREMENT PRIMARY KEY, listing_id INT NOT NULL, viewed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT fk_views_listing FOREIGN KEY(listing_id) REFERENCES listings(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;
-- Password demo untuk kedua akun: Demo1234 (hash bcrypt PHP).
INSERT IGNORE INTO users(nama_lengkap,email,password,role) VALUES
('Reza Kusuma','penjual@jbgarage.test','$2y$12$zpROlgYSjtFbxvk57ZLukeq8EsxNah2y4QG8.U8/coTrXumsRPzwm','penjual'),
('Andi Wijaya','pembeli@jbgarage.test','$2y$12$zpROlgYSjtFbxvk57ZLukeq8EsxNah2y4QG8.U8/coTrXumsRPzwm','pembeli')
ON DUPLICATE KEY UPDATE nama_lengkap=VALUES(nama_lengkap), password=VALUES(password), role=VALUES(role);

-- Data contoh dimasukkan hanya jika judul kendaraan tersebut belum ada.
INSERT INTO listings(user_id,judul,jenis,tahun,harga,kota,deskripsi,status,views)
SELECT u.id,v.judul,v.jenis,v.tahun,v.harga,v.kota,v.deskripsi,v.status,v.views
FROM users u JOIN (
 SELECT 'Honda Beat' judul,'motor' jenis,2021 tahun,12500000 harga,'Bandung' kota,'Honda Beat tahun 2021, kondisi terawat, surat lengkap, siap pakai.' deskripsi,'Aktif' status,324 views UNION ALL
 SELECT 'Honda Scoopy','motor',2020,13500000,'Cimahi','Honda Scoopy tahun 2020, kondisi terawat dan siap digunakan.','Aktif',187 UNION ALL
 SELECT 'Suzuki GSX-S150','motor',2019,18000000,'Bandung','Suzuki GSX-S150 tahun 2019, kondisi baik.','Review',96 UNION ALL
 SELECT 'Honda Brio','mobil',2018,115000000,'Bandung','Honda Brio tahun 2018, kendaraan terawat.','Terjual',633 UNION ALL
 SELECT 'Yamaha NMAX','motor',2019,21000000,'Jakarta','Yamaha NMAX tahun 2019, kondisi terawat.','Aktif',142 UNION ALL
 SELECT 'Honda Vario 125','motor',2020,12800000,'Bandung','Honda Vario 125 tahun 2020, surat lengkap.','Aktif',98 UNION ALL
 SELECT 'Toyota Avanza','mobil',2016,105000000,'Cimahi','Toyota Avanza tahun 2016, kondisi baik.','Aktif',211 UNION ALL
 SELECT 'Daihatsu Ayla','mobil',2017,78000000,'Bandung','Daihatsu Ayla tahun 2017, siap pakai.','Aktif',156 UNION ALL
 SELECT 'Yamaha Aerox 155','motor',2021,20500000,'Lembang','Yamaha Aerox 155 tahun 2021, kondisi terawat.','Aktif',120 UNION ALL
 SELECT 'Honda PCX 160','motor',2022,27000000,'Bandung','Honda PCX 160 tahun 2022, kondisi prima.','Aktif',305 UNION ALL
 SELECT 'Suzuki Ertiga','mobil',2015,112000000,'Garut','Suzuki Ertiga tahun 2015, kondisi terawat.','Aktif',77 UNION ALL
 SELECT 'Kawasaki Ninja 250','motor',2018,38000000,'Bandung','Kawasaki Ninja 250 tahun 2018.','Aktif',250 UNION ALL
 SELECT 'Mitsubishi Xpander','mobil',2019,185000000,'Jakarta','Mitsubishi Xpander tahun 2019, kondisi baik.','Aktif',189 UNION ALL
 SELECT 'Honda CBR150R','motor',2020,25000000,'Sumedang','Honda CBR150R tahun 2020, surat lengkap.','Aktif',134
) v ON u.email='penjual@jbgarage.test'
WHERE NOT EXISTS (SELECT 1 FROM listings old WHERE old.user_id=u.id AND old.judul=v.judul);

-- Kaitkan foto bawaan project ke empat listing contoh (jika belum memiliki foto).

INSERT INTO listing_images (listing_id, image_path)

SELECT
    l.id,
    v.path

FROM listings AS l

JOIN (
    -- FOTO MOTOR

    SELECT
        'Honda Beat' AS judul,
        'assets/img/honda-beat-2021.jpg' AS path

    UNION ALL

    SELECT
        'Honda Scoopy',
        'assets/img/honda-scoopy-2020.jpg'

    UNION ALL

    SELECT
        'Suzuki GSX-S150',
        'assets/img/suzuki-gsx-s150-2019.jpg'

    UNION ALL

    SELECT
        'Yamaha Aerox 155',
        'assets/img/aerox.jpeg'

    UNION ALL

    SELECT
        'Kawasaki Ninja 250',
        'assets/img/ninja.jpg'

    UNION ALL

    SELECT
        'Honda PCX 160',
        'assets/img/pcx.jpg'


    -- FOTO MOBIL

    UNION ALL

    SELECT
        'Honda Brio',
        'assets/img/honda-brio-2018.jpg'

    UNION ALL

    SELECT
        'Suzuki Ertiga',
        'assets/img/ertiga.jpg'

    UNION ALL

    SELECT
        'Mitsubishi Xpander',
        'assets/img/xpander.jpg'

) AS v ON v.judul = l.judul

JOIN users AS u
    ON u.id = l.user_id

WHERE
    u.email = 'penjual@jbgarage.test'

    AND NOT EXISTS (
        SELECT 1
        FROM listing_images AS i
        WHERE
            i.listing_id = l.id
            AND i.image_path = v.path
    );

