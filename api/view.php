
<?php

// ==========================================
// JB GARAGE - LISTING VIEW API
// Menghitung dan mencatat kunjungan kendaraan
// ==========================================


// 1. Memanggil konfigurasi database
require __DIR__ . '/bootstrap.php';


// 2. Memastikan request menggunakan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond([
        'success' => false,
        'message' => 'Metode request tidak diizinkan.'
    ], 405);
}


// 3. Mengambil data JSON
$d = body_json();


// 4. Mengambil ID kendaraan
$id = (int) ($d['id'] ?? 0);

if ($id <= 0) {
    respond([
        'success' => false,
        'message' => 'ID kendaraan tidak valid.'
    ], 400);
}


// 5. Memulai transaksi database
$pdo->beginTransaction();

try {

    // 6. Menambahkan jumlah kunjungan
    $q = $pdo->prepare("
        UPDATE listings
        SET views = views + 1
        WHERE id = ?
        AND status = 'Aktif'
    ");

    $q->execute([$id]);


    // 7. Memastikan kendaraan ditemukan dan aktif
    if ($q->rowCount() === 0) {
        $pdo->rollBack();

        respond([
            'success' => false,
            'message' => 'Iklan tidak ditemukan atau tidak aktif.'
        ], 404);
    }


    // 8. Menyimpan riwayat kunjungan
    $insert = $pdo->prepare("
        INSERT INTO listing_views (listing_id)
        VALUES (?)
    ");

    $insert->execute([$id]);


    // 9. Mengambil data kendaraan terbaru
    $l = listing_row($pdo, $id);


    // 10. Menyelesaikan transaksi
    $pdo->commit();


    // 11. Mengirim respons berhasil
    respond([
        'success' => true,
        'message' => 'Kunjungan berhasil dicatat.',
        'listing' => $l
    ]);

} catch (Throwable $e) {

    // Membatalkan transaksi jika terjadi error
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    respond([
        'success' => false,
        'message' => 'Gagal mencatat kunjungan.'
    ], 500);
}

