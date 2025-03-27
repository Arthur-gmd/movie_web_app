<?php
require_once 'config.php';

function search_movies($genre = null, $year = null, $min_vote_count = 100) {
    $url = BASE_URL . "/discover/movie";
    $params = [
        'api_key' => API_KEY,
        'language' => 'fr-FR',
        'sort_by' => 'popularity.desc',
        'vote_count.gte' => $min_vote_count,
    ];

    if ($genre) {
        $params['with_genres'] = $genre;
    }
    if ($year) {
        $params['primary_release_year'] = $year;
    }

    $query = $url . '?' . http_build_query($params);
    $response = file_get_contents($query);
    return json_decode($response, true)['results'];
}

function get_movie_details($movie_id) {
    $url = BASE_URL . "/movie/{$movie_id}";
    $params = [
        'api_key' => API_KEY,
        'language' => 'fr-FR',
    ];

    $query = $url . '?' . http_build_query($params);
    $response = file_get_contents($query);
    return json_decode($response, true);
}

function get_movie_videos($movie_id) {
    $url = BASE_URL . "/movie/{$movie_id}/videos";
    $params = [
        'api_key' => API_KEY,
        'language' => 'fr-FR',
    ];

    $query = $url . '?' . http_build_query($params);
    $response = file_get_contents($query);
    return json_decode($response, true)['results'];
}

function search_movie_by_name($name) {
    $url = BASE_URL . "/search/movie";
    $params = [
        'api_key' => API_KEY,
        'language' => 'fr-FR',
        'query' => $name,
        'sort_by' => 'popularity.desc',
        'page' => 1,
    ];

    $query = $url . '?' . http_build_query($params);
    $response = file_get_contents($query);
    return json_decode($response, true)['results'];
}
?>
