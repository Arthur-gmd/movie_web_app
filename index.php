<?php
session_start();
require_once 'config.php';
require_once 'database.php';
require_once 'api_client.php';

initialize_database();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$genres = ["Action", "Aventure", "Animation", "Comédie", "Crime", "Documentaire",
    "Drame", "Famille", "Fantastique", "Guerre", "Histoire", "Horreur",
    "Musique", "Mystère", "Romance", "Science-Fiction", "TV Movie", "Thriller", "Western"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_genres = $_POST['genre'] ?? [];
    $years = $_POST['year'] ?? [];

    if (empty($selected_genres) && empty($years)) {
        $error = "Veuillez sélectionner au moins un genre ou une année.";
    } else {
        $genre_id = [
            "action" => 28, "aventure" => 12, "animation" => 16, "comédie" => 35, "crime" => 80,
            "documentaire" => 99, "drame" => 18, "famille" => 10751, "fantastique" => 14,
            "guerre" => 10752, "histoire" => 36, "horreur" => 27, "musique" => 10402,
            "mystère" => 9648, "romance" => 10749, "science-fiction" => 878, "tv movie" => 10770,
            "thriller" => 53, "western" => 37
        ];

        $genre_ids = array_map(function($genre) use ($genre_id) {
            return $genre_id[strtolower($genre)];
        }, $selected_genres);

        $movies = [];
        foreach ($years as $year) {
            $movies = array_merge($movies, search_movies($genre_ids[0] ?? null, $year));
        }

        if (empty($movies)) {
            $error = "Aucun film trouvé.";
        } else {
            $selected_movies = array_slice($movies, 0, 3);
            $content = 'templates/search_results.php';
            include 'templates/base.php';
            exit;
        }
    }
}

$content = 'templates/index.php'; // Définir le contenu à inclure
include 'templates/base.php';
?>
