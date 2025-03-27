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
    $rating = $_POST['rating'];
    add_movie_rating($_SESSION['username'], $movie_id, $rating);
    $success = "Film noté avec succès!";
    header('Location: index.php');
    exit;
}
?>
