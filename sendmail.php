<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et nettoyage des données
    $nom = strip_tags(trim($_POST["nom"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $type = strip_tags(trim($_POST["type"]));
    $message = trim($_POST["message"]);

    // Validation simple
    if (empty($nom) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Merci de remplir correctement les champs Nom et Email.";
        exit;
    }

    // Préparation du mail
    $to = "wsdtransport51@gmail.com";
    $subject = "Demande de devis - WSD Transport";
    $content = "Nom : $nom\n";
    $content .= "Email : $email\n";
    $content .= "Type de transport : $type\n\n";
    $content .= "Détails :\n$message\n";

    $headers = "From: $nom <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    // Envoi du mail
    if (mail($to, $subject, $content, $headers)) {
        echo "Merci, votre demande de devis a été envoyée avec succès.";
    } else {
        echo "Une erreur est survenue lors de l'envoi de votre demande.";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
