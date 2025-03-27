<?php
session_start();
require_once 'config.php';
require_once 'database.php';

$content = 'templates/register.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (get_user($username)) {
        $error = "Ce nom d'utilisateur est déjà pris.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Ajouter l'utilisateur avec le mot de passe haché
        add_user($username, $hashed_password);
        $success = "Utilisateur enregistré avec succès!";
        header('Location: login.php');
        exit;
    }
}

include 'templates/base.php';
?>
