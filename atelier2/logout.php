<?php
session_start();
setcookie('authToken', '', time() - 3600, '/'); // supprimer le cookie
session_destroy(); // détruire la session
header('Location: login.php');
exit();
?>
