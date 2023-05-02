<html>
<body>
<h1>Reception des données du formulaire</h1>
<?php

$ID = $_GET['id'];
$TITRE = $_GET['titre'];
$GENRE = $_GET['genre'];
$ANNEE = $_GET['annee'];

echo $ID . " " . $TITRE . " " . $GENRE . " " . $ANNEE;

//1° - Connexion à la BDD
$base = new PDO('mysql:host=localhost; dbname=id20172939_movies', 'id20172939_root', 'C>3Gmt-4_2h3Fp)/');
$base->exec("SET CHARACTER SET utf8");

//2° - Préparation de requette et execution using prepared statements
$sql = 'INSERT INTO movies (id, titre, genre, annee) VALUES (:id, :titre, :genre, :annee)';
$stmt = $base->prepare($sql);
$stmt->bindParam(':id', $ID, PDO::PARAM_INT);
$stmt->bindParam(':titre', $TITRE, PDO::PARAM_STR);
$stmt->bindParam(':genre', $GENRE, PDO::PARAM_STR);
$stmt->bindParam(':annee', $ANNEE, PDO::PARAM_INT);
$stmt->execute();

?>
</br><a href="index.html">Retour à la page principale</a>
</body>
</html>
