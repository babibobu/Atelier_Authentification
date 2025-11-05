<?php
session_start();

// Vérification : le cookie et la session doivent correspondre
if (!isset($_COOKIE['authToken']) || !isset($_SESSION['authToken']) || $_COOKIE['authToken'] !== $_SESSION['authToken'] || $_SESSION['role'] !== 'user') {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Utilisateur</title>
</head>
<body>
    <h1>Bienvenue dans votre espace utilisateur 👤</h1>
    <p>Vous êtes connecté en tant qu’utilisateur simple.</p>
    <p>Votre session restera active pendant 1 minute.</p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
