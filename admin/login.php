<?php
require 'config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';
    if ($user === ADMIN_USER && $pass === ADMIN_PASS) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = 'Neplatné přihlašovací údaje';
    }
}
?>
<!doctype html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <title>Admin přihlášení</title>
</head>
<body>
    <h1>Přihlášení</h1>
    <?php if ($error) echo "<p style='color:red'>$error</p>"; ?>
    <form method="post">
        <label>Uživatelské jméno: <input name="username"></label><br>
        <label>Heslo: <input type="password" name="password"></label><br>
        <button type="submit">Přihlásit</button>
    </form>
</body>
</html>
