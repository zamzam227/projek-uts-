<?php

// Memanggil bootstrap
require __DIR__ . '/bootstrap.php';


// Memastikan request menggunakan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond([
        'success' => false
    ], 405);
}


// Mengambil data dari request JSON
$d = body_json();

$name = trim($d['name'] ?? '');
$email = trim($d['email'] ?? '');
$msg = trim($d['message'] ?? '');


// Validasi input
if (
    $name === '' ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    $msg === ''
) {
    respond([
        'success' => false,
        'message' => 'Lengkapi nama, email, dan pesan.'
    ], 422);
}


// Menyimpan pesan ke database
$q = $pdo->prepare("
    INSERT INTO contact_messages (
        nama,
        email,
        subjek,
        pesan
    )
    VALUES (?, ?, ?, ?)
");

$q->execute([
    $name,
    $email,
    'Pesan dari website',
    $msg
]);


// Mengirim response berhasil
respond([
    'success' => true,
    'message' => 'Pesan berhasil dikirim.'
]);