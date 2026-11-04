<?php

// Memanggil bootstrap
require __DIR__ . '/bootstrap.php';


// Memastikan request menggunakan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    respond([
        'success' => false,
        'message' => 'Method tidak diizinkan.'
    ], 405);
}


// Mengambil data dari request JSON
$d = body_json();

$name = trim($d['name'] ?? '');

$email = strtolower(
    trim($d['email'] ?? '')
);

$pw = $d['password'] ?? '';

$role = $d['role'] ?? 'pembeli';


// Validasi data registrasi
if (
    mb_strlen($name) < 3 ||
    mb_strlen($name) > 60 ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    strlen($pw) < 8 ||
    !in_array($role, ['pembeli', 'penjual'], true)
) {
    respond([
        'success' => false,
        'message' => 'Data tidak valid. Periksa nama, email, peran, dan password minimal 8 karakter.'
    ], 422);
}


// Proses menyimpan data pengguna
try {

    $q = $pdo->prepare("
        INSERT INTO users (
            nama_lengkap,
            email,
            password,
            role
        )
        VALUES (?, ?, ?, ?)
    ");

    $q->execute([
        $name,
        $email,
        password_hash($pw, PASSWORD_DEFAULT),
        $role
    ]);


    // Mengirim response registrasi berhasil
    respond([
        'success' => true,
        'message' => 'Registrasi berhasil.'
    ]);


} catch (PDOException $e) {

    // Memeriksa apakah email sudah terdaftar
    if ($e->getCode() === '23000') {

        respond([
            'success' => false,
            'message' => 'Email sudah terdaftar.'
        ], 409);
    }


    // Mengirim response jika registrasi gagal
    respond([
        'success' => false,
        'message' => 'Registrasi gagal.'
    ], 500);
}