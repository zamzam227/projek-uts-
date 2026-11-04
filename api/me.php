<?php

// Memanggil bootstrap
require __DIR__ . '/bootstrap.php';


// Mengambil data user yang sedang login
$u = current_user();


// Memeriksa status login
if (!$u) {

    respond([
        'success' => false,
        'message' => 'Belum login.'
    ], 401);
}


// Mengirim informasi user
respond([
    'success' => true,
    'user' => $u
]);