<?php
// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'autocompletion');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = $conn->real_escape_string($_GET['search']);
$query = "SELECT * FROM animaux WHERE nom LIKE '$search%' UNION SELECT * FROM animaux WHERE nom LIKE '%$search%'";
$result = $conn->query($query);

$suggestions = [];
while ($row = $result->fetch_assoc()) {
    $suggestions[] = $row;
}

header('Content-Type: application/json');
echo json_encode($suggestions);

$conn->close();
?>