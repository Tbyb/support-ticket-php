<?php
session_start();
$mdp = "admin";

// Déconnexion
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

if (isset($_POST['password'])) {
    if ($_POST['password'] === $mdp) {
        $_SESSION['admin'] = true;
    } else {
        $erreur = "Mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Tickets support</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container bg-white p-4 shadow rounded">
    <?php if (!isset($_SESSION['admin'])): ?>
        <h2><i class="bi bi-lock-fill"></i> Accès admin</h2>
        <?php if (isset($erreur)) echo "<div class='alert alert-danger'>$erreur</div>"; ?>
        <form method="POST" class="mt-3">
            <input type="password" name="password" class="form-control mb-3" placeholder="Mot de passe admin">
            <button type="submit" class="btn btn-dark"><i class="bi bi-shield-lock"></i> Connexion</button>
        </form>
    <?php else: ?>
        <div class="d-flex justify-content-between align-items-center">
            <h2><i class="bi bi-inbox-fill"></i> Tickets enregistrés</h2>
            <div>
                <a href="index.php" class="btn btn-outline-secondary me-2"><i class="bi bi-house"></i> Retour</a>
                <a href="?logout=1" class="btn btn-outline-danger"><i class="bi bi-box-arrow-right"></i> Déconnexion</a>
            </div>
        </div>
        <hr>
        <?php
        $dir = "tickets";
        if (is_dir($dir)) {
            $fichiers = array_diff(scandir($dir), ['.', '..']);
            if (empty($fichiers)) {
                echo "<p>Aucun ticket pour le moment.</p>";
            } else {
                foreach ($fichiers as $f) {
                    echo "<div class='mb-3'>";
                    echo "<h5 class='text-primary'><i class='bi bi-file-earmark-text'></i> $f</h5>";
                    echo "<pre class='bg-light p-3 border'>" . htmlspecialchars(file_get_contents("$dir/$f")) . "</pre>";
                    echo "</div><hr>";
                }
            }
        } else {
            echo "<p>Aucun ticket trouvé.</p>";
        }
        ?>
    <?php endif; ?>
</div>

</body>
</html>
