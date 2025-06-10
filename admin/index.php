<?php
require 'config.php';
require_login();
$jobs = load_jobs();
?>
<!doctype html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <title>Správa pozic</title>
</head>
<body>
    <h1>Správa pracovních pozic</h1>
    <p><a href="edit.php">Přidat pozici</a> | <a href="logout.php">Odhlásit se</a></p>
    <ul>
    <?php foreach ($jobs as $job): ?>
        <li>
            <?php echo htmlspecialchars($job['title']); ?>
            [<a href="edit.php?id=<?php echo $job['id']; ?>">upravit</a>]
            [<a href="delete.php?id=<?php echo $job['id']; ?>" onclick="return confirm('Opravdu smazat?');">smazat</a>]
        </li>
    <?php endforeach; ?>
    </ul>
</body>
</html>
