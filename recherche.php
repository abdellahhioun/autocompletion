<?php
$search = $_GET['search'] ?? '';
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

// Requête pour les correspondances exactes
$query_exact = "SELECT * FROM pokemons WHERE nom LIKE :searchExact";
$stmt_exact = $pdo->prepare($query_exact);
$stmt_exact->execute(['searchExact' => "$search%"]);
$exact_results = $stmt_exact->fetchAll(PDO::FETCH_ASSOC);

// Requête pour les correspondances partielles
$query_partial = "SELECT * FROM pokemons WHERE nom LIKE :searchPartial AND nom NOT LIKE :searchExact";
$stmt_partial = $pdo->prepare($query_partial);
$stmt_partial->execute(['searchPartial' => "%$search%", 'searchExact' => "$search%"]);
$partial_results = $stmt_partial->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de recherche</title>
</head>
<body>
    <h1>Résultats pour "<?= htmlspecialchars($search) ?>"</h1>

    <h2>Correspondances exactes :</h2>
    <?php if (count($exact_results) > 0): ?>
        <ul>
            <?php foreach ($exact_results as $pokemon): ?>
                <li>
                    <a href="element.php?id=<?= $pokemon['id'] ?>">
                        <img src="<?= htmlspecialchars($pokemon['image_url']) ?>" alt="<?= htmlspecialchars($pokemon['nom']) ?>" style="width:50px;">
                        <?= htmlspecialchars($pokemon['nom']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun résultat exact trouvé.</p>
    <?php endif; ?>

    <h2>Correspondances partielles :</h2>
    <?php if (count($partial_results) > 0): ?>
        <ul>
            <?php foreach ($partial_results as $pokemon): ?>
                <li>
                    <a href="element.php?id=<?= $pokemon['id'] ?>">
                        <img src="<?= htmlspecialchars($pokemon['image_url']) ?>" alt="<?= htmlspecialchars($pokemon['nom']) ?>" style="width:50px;">
                        <?= htmlspecialchars($pokemon['nom']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun résultat partiel trouvé.</p>
    <?php endif; ?>
</body>
</html>
