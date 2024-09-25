<?php
// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'autocompletion');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = $conn->real_escape_string($_GET['search']);
$query = "SELECT * FROM animaux WHERE nom LIKE '%$search%'";
$result = $conn->query($query);

// Define image URLs in an associative array
$imageUrls = [
    'Chien' => 'https://images.pexels.com/photos/416160/pexels-photo-416160.jpeg',
    'Chat' => 'https://images.pexels.com/photos/45170/cat-pet-animal-adorable-45170.jpeg',
    'Oiseau' => 'https://images.pexels.com/photos/459225/pexels-photo-459225.jpeg',
    'Poisson' => 'https://images.pexels.com/photos/161931/sea-fish-aquarium-fish-tank-161931.jpeg',
    'Lapin' => 'https://images.pexels.com/photos/1239294/pexels-photo-1239294.jpeg',
    'Tigre' => 'https://images.pexels.com/photos/459225/pexels-photo-459225.jpeg',
    'Lion' => 'https://images.pexels.com/photos/46062/lion-wild-animal-africa-46062.jpeg',
    'Éléphant' => 'https://images.pexels.com/photos/46062/lion-wild-animal-africa-46062.jpeg',
    'Singe' => 'https://images.pexels.com/photos/208180/pexels-photo-208180.jpeg',
    'Dauphin' => 'https://images.pexels.com/photos/248280/pexels-photo-248280.jpeg',
    'Serpent' => 'https://images.pexels.com/photos/161931/sea-fish-aquarium-fish-tank-161931.jpeg',
    'Tortue' => 'https://images.pexels.com/photos/161931/sea-fish-aquarium-fish-tank-161931.jpeg',
    'Faucon' => 'https://images.pexels.com/photos/459225/pexels-photo-459225.jpeg',
    'Rhinocéros' => 'https://images.pexels.com/photos/46062/lion-wild-animal-africa-46062.jpeg',
    'Zèbre' => 'https://images.pexels.com/photos/46062/lion-wild-animal-africa-46062.jpeg',
    'Loup' => 'https://images.pexels.com/photos/208180/pexels-photo-208180.jpeg',
    'Panda' => 'https://images.pexels.com/photos/46062/lion-wild-animal-africa-46062.jpeg',
    'Koala' => 'https://images.pexels.com/photos/46062/lion-wild-animal-africa-46062.jpeg',
    'Hérisson' => 'https://images.pexels.com/photos/208180/pexels-photo-208180.jpeg',
    'Cangourou' => 'https://images.pexels.com/photos/46062/lion-wild-animal-africa-46062.jpeg',
];

if ($result->num_rows > 0) {
    echo "<h1>Résultats pour '$search'</h1><ul>";
    while ($row = $result->fetch_assoc()) {
        $animalName = $row['nom'];
        $imageUrl = $imageUrls[$animalName] ?? ''; // Get the image URL from the array
        echo "<li>
                <a href='element.php?id=" . $row['id'] . "'>
                    <img src='" . $imageUrl . "' alt='" . $animalName . "' style='width:50px;height:50px;'>
                    " . $animalName . "
                </a>
              </li>";
    }
    echo "</ul>";
} else {
    echo "<h1>Aucun résultat trouvé.</h1>";
}

$conn->close();
?>