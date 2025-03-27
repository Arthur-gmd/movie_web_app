<h1>Recherche de Films</h1>
<form action="index.php" method="post">
    <div class="form-group">
        <label for="genres">Genres :</label>
        <select class="form-control" id="genres" name="genre[]" multiple>
            <?php foreach ($genres as $genre): ?>
                <option value="<?php echo strtolower($genre); ?>"><?php echo $genre; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="years">Années :</label>
        <select class="form-control" id="years" name="year[]" multiple>
            <?php for ($year = 2025; $year >= 1980; $year--): ?>
                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
            <?php endfor; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Rechercher</button>
</form>

<form action="search_by_name.php" method="post" class="mt-4">
    <div class="form-group">
        <label for="movie_name">Nom du film :</label>
        <input type="text" class="form-control" id="movie_name" name="movie_name" required>
    </div>
    <button type="submit" class="btn btn-secondary">Rechercher par nom</button>
</form>

