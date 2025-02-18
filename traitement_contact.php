<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"]));

    // Vérification des données
    if (empty($nom) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Une erreur est survenue. Veuillez vérifier vos informations.";
        exit;
    }

    // Destinataire
    $destinataire = "sebastien.boulevard@gmail.com"; // Remplacez par votre email

    // Sujet
    $sujet = "Nouveau message de $nom";

    // En-têtes de l'email
    $headers = "From: $nom <$email>";

    // Envoi de l'email
    if (mail($destinataire, $sujet, $message, $headers)) {
        http_response_code(200);
        echo "Message envoyé avec succès !";
    } else {
        http_response_code(500);
        echo "Une erreur est survenue lors de l'envoi du message.";
    }
} else {
    http_response_code(403);
    echo "Il y a eu un problème avec votre soumission, veuillez réessayer.";
}
?>