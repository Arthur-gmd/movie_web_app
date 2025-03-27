<?php
session_start();
require 'config.php';
require 'database.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movie_id = $_POST['movie_id'];
    delete_movie_rating($_SESSION['username'], $movie_id);
    $success = "Film supprimé de la bibliothèque avec succès!";
    header('Location: library.php');
    exit;
}
?>
