<?php
date_default_timezone_set('Africa/Dakar');
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $id = uniqid("ticket_", true);
    $date = date('Y-m-d_H-i-s');
    
    $contenu = "ID : $id\nNom : $nom\nEmail : $email\nMessage : $message\nDate : $date\n";
    
    if (!is_dir("tickets")) mkdir("tickets");
    file_put_contents("tickets/$id.txt", $contenu);
    
    $confirmation = "Votre ticket a été enregistré avec succès !";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Support - Déposer un ticket</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap + icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container bg-white p-4 shadow rounded">
    <h2><i class="bi bi-envelope-paper-fill"></i> Formulaire de support</h2>
    <?php if (isset($confirmation)): ?>
        <div class="alert alert-success mt-3"><?= $confirmation ?></div>
    <?php endif; ?>

    <form method="POST" class="mt-3">
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" rows="4" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Envoyer</button>
    </form>
</div>

</body>
</html>
