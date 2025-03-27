<?php
session_start();
require_once 'config.php';
require_once 'database.php';
require_once 'api_client.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$watched_movies = get_watched_movies($_SESSION['username']);
$movie_details = array_map(function($movie) {
    return get_movie_details($movie['movie_id']);
}, $watched_movies);


$content = 'templates/library.php'; // Définir le contenu à inclure
include 'templates/base.php';
?>
