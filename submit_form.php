<?php
// Zkontrolujte, zda byla data odeslána prostřednictvím formuláře POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Získejte data z formuláře
    $name = $_POST["name"];
    $category = $_POST["category"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];
    $attachment = $_FILES["attachment"]; // Pro přílohu

    // Zvolte příjemce na základě výběru kategorie
    if ($category == "prace") {
        $recipient = "nabor@bpsa.cz";
    } else {
        $recipient = "hajduk@bpsa.cz";
    }

    // Předmět emailu
    $subject = "Nová žádost z webu - $category";

    // Obsah emailu
    $email_message = "Jméno/název firmy: $name\n";
    $email_message .= "Email: $email\n";
    $email_message .= "Telefonní číslo: $phone\n";
    $email_message .= "Zpráva: \n$message";

    // Poslat e-mail
    mail($recipient, $subject, $email_message);

    // Přesměrovat na děkovací stránku nebo zobrazit potvrzovací zprávu
    header("Location: thank_you.html"); // Vytvořte stránku thank_you.html
    exit;
} else {
    // Pokud nebyla data odeslána prostřednictvím POST, přesměrovat na domovskou stránku
    header("Location: index.html");
    exit;
}
?>
