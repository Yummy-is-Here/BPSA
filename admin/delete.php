<?php
require 'config.php';
require_login();
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $jobs = load_jobs();
    $jobs = array_values(array_filter($jobs, function($j) use ($id) { return $j['id'] != $id; }));
    save_jobs($jobs);
}
header('Location: index.php');
exit;
