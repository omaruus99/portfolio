<?php
// Vérifiez si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assignez les données du formulaire à des variables
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"]));

    // Vérifiez que les données nécessaires sont présentes
    if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Vous pouvez rediriger l'utilisateur vers une page d'erreur ici
        echo "Oups! Il y a eu un problème avec votre soumission. Veuillez compléter le formulaire et réessayer.";
        exit;
    }

    // Définissez l'adresse email de réception des messages
    $recipient = "haddadomar02@gmail.com";

    // Définissez l'objet de l'email
    $subject = "Nouveau message de $name";

    // Construisez le corps de l'email
    $email_content = "Nom: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Construisez les headers de l'email
    $email_headers = "From: $name <$email>";

    // Envoyez l'email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Redirigez vers une page de remerciement ou affichez un message de succès
        echo "Merci! Votre message a été envoyé.";
    } else {
        echo "Oups! Quelque chose s'est mal passé et nous n'avons pas pu envoyer votre message.";
    }

} else {
    // Si le formulaire n'est pas soumis via POST, redirigez l'utilisateur vers le formulaire HTML
    echo "Il y a eu un problème avec votre soumission, veuillez essayer à nouveau.";
}
?>
