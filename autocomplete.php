<?php
$query = $_GET['query'] ?? '';

$db = new mysqli('localhost', 'root', '', 'autocompletion');

$exactMatches = [];
$partialMatches = [];

if ($query !== '') {
    // Get exact matches (start with the query)
    $stmt = $db->prepare("SELECT name, image FROM items WHERE name LIKE CONCAT(?, '%')");
    $stmt->bind_param('s', $query);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $exactMatches[] = $row;
    }

    // Get partial matches (contain the query)
    $stmt = $db->prepare("SELECT name, image FROM items WHERE name LIKE CONCAT('%', ?, '%') AND name NOT LIKE CONCAT(?, '%')");
    $stmt->bind_param('ss', $query, $query);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $partialMatches[] = $row;
    }
}

echo json_encode([
    'exactMatches' => $exactMatches,
    'partialMatches' => $partialMatches,
]);
?>
