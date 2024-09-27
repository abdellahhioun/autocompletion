<?php
$id = $_GET['id'] ?? 0;
$host = 'localhost';
$dbname = 'autocompletion';
$username = 'root';
$password = '';

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Requête pour récupérer les informations de l'élément
$query = "SELECT * FROM pokemons WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $id]);
$pokemon = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pokemon) {
    die("Le Pokémon demandé n'existe pas.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pokemon['nom']) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($pokemon['nom']) ?></h1>
    <p><?= htmlspecialchars($pokemon['description']) ?></p>
    <img src="<?= htmlspecialchars($pokemon['image_url']) ?>" alt="<?= htmlspecialchars($pokemon['nom']) ?>" style="width:200px;">
    <a href="index.php">Retour à la recherche</a>
</body>
</html>
