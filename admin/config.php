<?php
session_start();

const ADMIN_USER = 'admin';
const ADMIN_PASS = 'heslo'; // simple password

function require_login() {
    if (empty($_SESSION['admin_logged_in'])) {
        header('Location: login.php');
        exit;
    }
}

function load_jobs() {
    $file = __DIR__ . '/../positions.json';
    if (!file_exists($file)) return [];
    $data = json_decode(file_get_contents($file), true);
    return is_array($data) ? $data : [];
}

function save_jobs(array $jobs) {
    $file = __DIR__ . '/../positions.json';
    file_put_contents($file, json_encode($jobs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
