<?php
session_start();

// Si un cookie + session existent et correspondent, rediriger selon le role
if (isset($_COOKIE['authToken']) && isset($_SESSION['authToken']) && $_COOKIE['authToken'] === $_SESSION['authToken']) {
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        header('Location: page_admin.php');
    } elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'user') {
        header('Location: page_user.php');
    } else {
        // pas de role → on détruit et on reste sur la page de login
        session_destroy();
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === 'secret') {
        $token = bin2hex(random_bytes(16));
        $_SESSION['authToken'] = $token;
        $_SESSION['role'] = 'admin';
        setcookie('authToken', $token, time() + 60, '/', '', false, true);
        header('Location: page_admin.php');
        exit();
    } elseif ($username === 'user' && $password === 'utilisateur') {
        $token = bin2hex(random_bytes(16));
        $_SESSION['authToken'] = $token;
        $_SESSION['role'] = 'user';
        setcookie('authToken', $token, time() + 60, '/', '', false, true);
        header('Location: page_user.php');
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>
    
    

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Atelier authentification par Cookie</h1>
    <h3>La page <a href="page_admin.php">page_admin.php</a> est inaccéssible tant que vous ne vous serez pas connecté avec le login 'admin' et mot de passe 'secret'</h3>
    <form method="POST" action="">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Se connecter</button>
    </form>
    <br>
    <a href="../index.html">Retour à l'accueil</a>  
</body>
</html>
