<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $category = $_POST['category'] ?? 'ostatni';
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $phone = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!$email) {
        header('Location: formular.html?error=email');
        exit;
    }

    $recipient = ($category === 'prace') ? 'nabor@bpsa.cz' : 'hajduk@bpsa.cz';
    $subject = "Nová žádost z webu - $category";

    $mail = new PHPMailer(true);
    try {
        $mail->setFrom($email, $name);
        $mail->addAddress($recipient);
        $mail->Subject = $subject;
        $mail->Body = "Jméno/název firmy: $name\n" .
                      "Email: $email\n" .
                      "Telefonní číslo: $phone\n" .
                      "Zpráva:\n$message";
        $mail->CharSet = 'UTF-8';
        if (!empty($_FILES['attachment']['tmp_name'])) {
            $mail->addAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
        }
        $mail->send();
    } catch (Exception $e) {
        error_log('Mail error: ' . $mail->ErrorInfo);
    }
    header('Location: thank_you.html');
    exit;
}
header('Location: index.html');
exit;
?>
