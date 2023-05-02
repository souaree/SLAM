<html>
<head>
    <title>Recherche de films par année (liste déroulante)</title>
</head>
<body>
<h1>Recherche de films par année (liste déroulante)</h1>

<?php
// 1° - Connexion à la BDD
$base = new PDO('mysql:host=localhost; dbname=id20172939_movies', 'id20172939_root', 'C>3Gmt-4_2h3Fp)/');
$base->exec("SET CHARACTER SET utf8");

// Get the unique years from the database
$yearsQuery = $base->query('SELECT DISTINCT annee FROM movies ORDER BY annee;');
$years = $yearsQuery->fetchAll(PDO::FETCH_COLUMN, 0);
?>

<!-- Add a new form for searching movies by year using a dropdown list -->
<form action="" method="post">
    <label for="annee">Rechercher un film par année :</label>
    <select name="annee" id="annee" required>
        <?php foreach ($years as $year): ?>
            <option value="<?= htmlspecialchars($year) ?>"><?= htmlspecialchars($year) ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Rechercher">
</form>

<?php
// If the form is submitted, process the data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $searchYear = $_POST['annee'];

    // 2° - Préparation de requette et execution
    $query = $base->prepare('SELECT * FROM movies WHERE annee = :annee;');
    $query->bindParam(':annee', $searchYear, PDO::PARAM_INT);
    $query->execute();

    // 3° - Lecture du resultat de la requette
    if ($query->rowCount() > 0) {
        echo "<h2>Films de l'année " . htmlspecialchars($searchYear) . " :</h2>";
        while ($data = $query->fetch()) {
            echo $data['id'] . " " . $data['titre'] . " " . $data['genre'] . " " . $data['annee'] . "</br>";
        }
    } else {
        echo "<p>Aucun film trouvé pour l'année " . htmlspecialchars($searchYear) . ".</p>";
    }
}
?>

</br><a href="index.html">Retour à la page principale</a>
</body>
</html>
