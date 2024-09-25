<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Moteur de recherche</title>
    <script src="autocompletion.js"></script>
    <style>
        #suggestions {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            display: none;
        }
        .suggestion {
            padding: 8px;
            cursor: pointer;
        }
        .suggestion:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <header>
        <form action="recherche.php" method="GET">
            <input type="text" id="search" name="search" placeholder="Rechercher...">
            <div id="suggestions"></div>
        </form>
    </header>
    <h1>Bienvenue sur le moteur de recherche d'animaux</h1>
    <!-- ... contenu de la page d'accueil ... -->
</body>
</html>
