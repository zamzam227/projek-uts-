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

$email = strtolower(
    trim($d['email'] ?? '')
);

$pw = $d['password'] ?? '';


// Mencari user berdasarkan email
$q = $pdo->prepare("
    SELECT
        id,
        nama_lengkap,
        email,
        password,
        role
    FROM users
    WHERE email = ?
    LIMIT 1
");

$q->execute([$email]);

$u = $q->fetch();


// Memeriksa email dan password
if (
    !$u ||
    !password_verify($pw, $u['password'])
) {
    respond([
        'success' => false,
        'message' => 'Email atau password salah.'
    ], 401);
}


// Memperbarui session ID
session_regenerate_id(true);


// Menyimpan data user ke session
$_SESSION['user'] = [
    'id' => (int) $u['id'],
    'name' => $u['nama_lengkap'],
    'email' => $u['email'],
    'role' => $u['role']
];


// Mengirim response login berhasil
respond([
    'success' => true,
    'message' => 'Login berhasil.',
    'user' => $_SESSION['user']
]);