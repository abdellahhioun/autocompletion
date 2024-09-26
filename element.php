<?php
$id = $_GET['id'];

$db = new mysqli('localhost', 'root', '', 'autocompletion');
$query = $db->prepare("SELECT * FROM items WHERE id = ?");
$query->bind_param('i', $id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h1>" . $row['name'] . "</h1>";
    echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "' style='width: 200px; height: 200px;'>";
    // Display other info about the item if available
} else {
    echo "Element not found.";
}
?>
