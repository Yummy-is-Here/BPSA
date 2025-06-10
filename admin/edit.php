<?php
require 'config.php';
require_login();
$jobs = load_jobs();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$job = ['id'=>0,'title'=>'','description'=>'','icon'=>''];
foreach ($jobs as $j) {
    if ($j['id'] == $id) { $job = $j; break; }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $desc = trim($_POST['description'] ?? '');
    $icon = trim($_POST['icon'] ?? '');
    if ($id) {
        foreach ($jobs as &$j) {
            if ($j['id'] == $id) { $j['title']=$title; $j['description']=$desc; $j['icon']=$icon; }
        }
        unset($j);
    } else {
        $id = count($jobs) ? max(array_column($jobs,'id')) + 1 : 1;
        $jobs[] = ['id'=>$id,'title'=>$title,'description'=>$desc,'icon'=>$icon];
    }
    save_jobs($jobs);
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <title><?php echo $id? 'Upravit' : 'Přidat'; ?> pozici</title>
</head>
<body>
    <h1><?php echo $id? 'Upravit' : 'Přidat'; ?> pozici</h1>
    <form method="post">
        <label>Název:<br><input name="title" value="<?php echo htmlspecialchars($job['title']); ?>"></label><br>
        <label>Ikona (FontAwesome třída):<br><input name="icon" value="<?php echo htmlspecialchars($job['icon']); ?>"></label><br>
        <label>Popis:<br><textarea name="description" rows="5" cols="40"><?php echo htmlspecialchars($job['description']); ?></textarea></label><br>
        <button type="submit">Uložit</button>
    </form>
    <p><a href="index.php">Zpět</a></p>
</body>
</html>
