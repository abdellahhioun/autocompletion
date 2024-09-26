<?php
$search = $_GET['search'] ?? '';

$db = new mysqli('localhost', 'root', '', 'autocompletion');
$query = $db->prepare("SELECT * FROM items WHERE name LIKE CONCAT(?, '%') OR name LIKE CONCAT('%', ?, '%')");
$query->bind_param('ss', $search, $search);
$query->execute();
$result = $query->get_result();

echo "<h1>Results for '$search'</h1>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div style='margin-bottom: 20px;'>";
        echo "<a href='element.php?id=" . $row['id'] . "'>";
        echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "' style='width: 100px; height: 100px;'>";
        echo "<br>" . $row['name'] . "</a>";
        echo "</div>";
    }
} else {
    echo "No results found.";
}
?>
