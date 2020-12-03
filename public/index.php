<?php

// Turn off all error reporting
error_reporting(0);

    $duree = + ($_GET['duree'] ?? 1);
    $categorie = $_GET['categorie'] ?? 'A';
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Estimateur</title>
    <link rel="stylesheet" href="../ressources/style.css">
</head>
<body>
    <h1><em>Location d'outils Chez Le Génie Inc.</em></h1>
    <h2>Estimateur de prix de location</h2>
    <p>Veuillez indiquer la durée de la location en jour puis appuyez sur le bouton correspondant au type d'outil :</p>
    <form id="form" method="GET" action="estimation.php">
        <p>
            <label>Durée (en jours):</label> 
            <input type="number" name="duree" value="<?= $duree ?>" min="1" max="30" oninput="formatDuree()" required autofocus>
        </p>
        <p>
            <label>Catégorie:</label> 
            <select name="categorie" onchange="formatCategorie(categorieLetter(this.selectedIndex))" required>
                <option value="A" <?php if ($categorie === 'A'){ echo 'selected';} ?>>A : Léger</option>
                <option value="W" <?php if ($categorie === 'W'){ echo 'selected';} ?>>W : Lourd</option>
                <option value="P" <?php if ($categorie === 'P'){ echo 'selected';} ?>>P : Professionnel</option>
            </select>
        </p>
        <p>
            <button type="submit">Estimer</button>
            <button type="button" onclick="alea()">Aléatoire</button>
            <button type="button" onclick="onReset()">Réinitialiser</button>
        </p>
    </form>

    <script>
        "use strict";

        let categorie = "<?= $categorie ?>";

        formatDuree();

        function alea(){
            form.duree.value = random(+form.duree.min, +form.duree.max);
            formatDuree();
            selectCategorie(categorieLetter(random(0,2)));
        }

        function categorieLetter(choix){
            switch(choix) {
                case 0: return "A";
                case 1: return "W";
                case 2: default: return "P";
            }
        }

        function formatDuree(){
            form.duree.style.background = "hsl(${210 - 3 * form.duree.value}, 90%, 60%)";
        }

        function formatCategorie(categorie){
            switch(categorie){
                case 'A' : 
                    form.categorie.style.background = "hsl(150, 70%, 60%)";
                    break;
                case 'W' : 
                    form.categorie.style.background = "hsl(210, 70%, 60%)";
                    break;
                case 'P' : default: 
                    form.categorie.style.background = "hsl(270, 70%, 60%)";
                    break;
            }            
        }

        function onReset(){
            form.duree.value = 1;
            formatDuree();
            selectCategorie('A');
        }

        function random(min, max) {
            return Math.trunc(Math.random()*(max-min+1)) + min;
        }

        function selectCategorie(categorie){
            $(`option[value="${categorie}"]`).selected = true;
            formatCategorie(categorie);
        }

        // Changement de catégorie
        function $(selecteur) {
            return document.querySelector(selecteur);
        }

    </script>
</body>
</html>
