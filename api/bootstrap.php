<?php

// Memulai session
if (session_status() !== PHP_SESSION_ACTIVE) {

    $secure = !empty($_SERVER['HTTPS'])
        && $_SERVER['HTTPS'] !== 'off';

    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => $secure,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    session_start();
}

// Header JSON
header('Content-Type: application/json; charset=utf-8');

// Koneksi database
require_once __DIR__ . '/../config/database.php';


// Mengirim response JSON
function respond($data, $code = 200)
{
    http_response_code($code);

    echo json_encode(
        $data,
        JSON_UNESCAPED_UNICODE
    );

    exit;
}


// Membaca data JSON dari request
function body_json()
{
    $v = json_decode(
        file_get_contents('php://input'),
        true
    );

    return is_array($v) ? $v : [];
}


// Mengambil data user dari session
function current_user()
{
    return $_SESSION['user'] ?? null;
}


// Memastikan user sudah login
function require_user()
{
    $u = current_user();

    if (!$u) {
        respond([
            'success' => false,
            'message' => 'Silakan login terlebih dahulu.'
        ], 401);
    }

    return $u;
}


// Memastikan user memiliki role penjual atau admin
function require_seller()
{
    $u = require_user();

    if (
        $u['role'] !== 'penjual' &&
        $u['role'] !== 'admin'
    ) {
        respond([
            'success' => false,
            'message' => 'Fitur ini khusus penjual.'
        ], 403);
    }

    return $u;
}


// Mengambil data detail iklan
function listing_row($pdo, $id)
{
    $q = $pdo->prepare("
        SELECT
            l.*,
            u.nama_lengkap AS owner_name
        FROM listings l
        JOIN users u
            ON u.id = l.user_id
        WHERE l.id = ?
    ");

    $q->execute([$id]);

    $l = $q->fetch();

    if (!$l) {
        return null;
    }


    // Mengambil gambar iklan
    $im = $pdo->prepare("
        SELECT image_path
        FROM listing_images
        WHERE listing_id = ?
        ORDER BY id
    ");

    $im->execute([$id]);

    $images = array_column(
        $im->fetchAll(),
        'image_path'
    );


    // Mengembalikan data iklan
    return [
        'id' => (string) $l['id'],
        'ownerId' => (int) $l['user_id'],
        'ownerName' => $l['owner_name'],
        'title' => $l['judul'],
        'type' => $l['jenis'],
        'year' => (int) $l['tahun'],
        'price' => (float) $l['harga'],
        'city' => $l['kota'],
        'desc' => $l['deskripsi'],
        'status' => $l['status'],
        'views' => (int) $l['views'],
        'images' => $images,
        'createdAt' => strtotime($l['created_at']) * 1000
    ];
}