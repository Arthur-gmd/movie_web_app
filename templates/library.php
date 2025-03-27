<?php
$watched_movies = get_watched_movies($_SESSION['username']);
$movie_details = array_map(function($movie) {
    $details = get_movie_details($movie['movie_id']);
    $details['rating'] = $movie['rating'];
    return $details;
}, $watched_movies);
?>

<h1>Bibliothèque de Films</h1>
<div class="card-container">
    <?php foreach ($movie_details as $movie): ?>
        <div class="card">
            <img src="<?php echo IMAGE_BASE_URL . $movie['poster_path']; ?>" class="card-img-top" alt="<?php echo $movie['title']; ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo $movie['title']; ?></h5>
                <p class="card-text">Note :
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <?php if ($i <= $movie['rating']): ?>
                            <span class="star">&#9733;</span>
                        <?php else: ?>
                            <span class="star">&#9734;</span>
                        <?php endif; ?>
                    <?php endfor; ?>
                </p>
                <form action="delete_movie.php" method="post" style="display:inline;">
                    <input type="hidden" name="movie_id" value="<?php echo $movie['id']; ?>">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>
