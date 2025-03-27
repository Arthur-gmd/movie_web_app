<h1>Résultats de Recherche</h1>

<div class="card-container">
    <?php if (!empty($selected_movies) && is_array($selected_movies)) : ?>
        <?php foreach ($selected_movies as $movie): ?>
            <div class="card">
                <img src="<?php echo IMAGE_BASE_URL . $movie['poster_path']; ?>" class="card-img-top" alt="<?php echo $movie['title']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($movie['title']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($movie['overview']); ?></p>
                    <form action="rate_movie.php" method="post">
                        <div class="form-group">
                            <label for="rating">Note :</label>
                            <div class="rating">
                                <?php for ($i = 5; $i >= 1; $i--): ?>
                                    <input type="radio" id="star<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>" />
                                    <label for="star<?php echo $i; ?>" class="star">&#9733;</label>
                                <?php endfor; ?>
                            </div>
                            <input type="hidden" name="movie_id" value="<?php echo $movie['id']; ?>">
                        </div>
                        <button type="submit" class="btn btn-success">Noter</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Aucun film trouvé.</p>
    <?php endif; ?>
</div>

