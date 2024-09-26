<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Engine</title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body>
  <header>
    <h1>Search Engine</h1>
    <form action="recherche.php" method="GET">
      <input type="text" id="search-input" name="search" placeholder="Search..." autocomplete="off">
      <div id="autocomplete-list"></div>
    </form>
  </header>

  <script src="js/autocomplete.js"></script>
</body>
</html>
