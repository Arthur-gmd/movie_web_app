<?php
session_start();
require 'config.php';
require 'database.php';
require 'api_client.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$selected_movies = []; // Initialisation pour éviter les erreurs

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['movie_name']) && !empty($_POST['movie_name'])) {
    $movie_name = $_POST['movie_name'];

    // Appelle l'API TMDb pour rechercher un film par son nom
    $movies = search_movie_by_name($movie_name);

    // Limiter à 3 films seulement
    $selected_movies = array_slice($movies, 0, 3);

    if (empty($selected_movies)) {
        $error = "Aucun film trouvé.";
    } else {
        $content = 'templates/search_results.php';
        include 'templates/base.php';
        exit;
    }
}

$content = 'templates/search_results.php';
include 'templates/base.php';
?>
