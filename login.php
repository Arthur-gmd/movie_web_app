<?php
session_start();
require_once 'config.php';
require_once 'database.php';

$content = 'templates/login.php'; // Définir le contenu à inclure

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = get_user($username);

    if ($user && password_verify($password, $user['password'])) {  // Vérifier si le mot de passe est correct
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

include 'templates/base.php';
?>
