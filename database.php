<?php
require_once 'config.php';

function get_db_connection() {
    try {
        return new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}

function initialize_database() {
    $conn = get_db_connection();
    $conn->exec('CREATE TABLE IF NOT EXISTS watched_movies (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        movie_id INT NOT NULL,
        rating INT NOT NULL
    )');
    $conn->exec('CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL
    )');
}

function add_movie_rating($username, $movie_id, $rating) {
    $conn = get_db_connection();
    $stmt = $conn->prepare("INSERT INTO watched_movies (username, movie_id, rating) VALUES (?, ?, ?)");
    $stmt->execute([$username, $movie_id, $rating]);
}

function get_watched_movies($username) {
    $conn = get_db_connection();
    $stmt = $conn->prepare("SELECT id, movie_id, rating FROM watched_movies WHERE username = ?");
    $stmt->execute([$username]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_user($username) {
    $conn = get_db_connection();
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function add_user($username, $hashed_password) {
    $conn = get_db_connection();
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $hashed_password]);
}

function delete_movie_rating($username, $movie_id) {
    $conn = get_db_connection();
    $stmt = $conn->prepare("DELETE FROM watched_movies WHERE username = ? AND movie_id = ?");
    $stmt->execute([$username, $movie_id]);
}
?>
