<?php
// Sesuaikan jika konfigurasi MySQL XAMPP Anda berbeda.
$host = 'localhost'; $dbname = 'jb_garage'; $username = 'root'; $password = '';
try {
    $pdo = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success'=>false, 'message'=>'Database belum tersedia. Import database.sql dan periksa config/database.php.']);
    exit;
}
