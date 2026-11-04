<?php

// Memanggil bootstrap
require __DIR__ . '/bootstrap.php';


// Mengosongkan seluruh data session
$_SESSION = [];


// Menghapus cookie session
if (ini_get('session.use_cookies')) {

    $p = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $p['path'],
        $p['domain'] ?? '',
        $p['secure'],
        $p['httponly']
    );
}


// Menghancurkan session
session_destroy();


// Mengirim response logout berhasil
respond([
    'success' => true,
    'message' => 'Logout berhasil.'
]);