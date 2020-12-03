<?php

// Turn off all error reporting
error_reporting(0);

$duree = + ($_GET['duree'] ?? 1);
$categorie = $_GET['categorie'] ?? 'A';

$total = estimation($categorie, $duree);
$rabais = tarif_quotidien($categorie) * $duree - $total;

$libelleJour = $duree >= 2 ? "jours" : "jour";
$strrabais = number_format($rabais, 2, '.', ''); 

$message_rabais = "";

if ($rabais > 0) {
    $message_rabais = ", une économie de <em>$strrabais $</em> sur le prix régulier";
}

$strtotal = number_format($total, 2, '.', '');
$message = "Pour la location d'un outil de catégorie <em>$categorie</em> pendant <em>$duree</em> $libelleJour, le coût total de la location <b><u>avant taxe</u></b> sera <em>$strtotal $</em>$message_rabais.";

include 'template.php';

function tarif_quotidien(string $categorie): float {
    switch($categorie) {
        case 'A': 
            return 15.50;
        case 'W': 
            return 42.00;
        case 'P':
        default: 
            return 50.00;
    }
}

function estimation(string $categorie, int $duree): float {
    $total = tarif_quotidien($categorie) * $duree;

    if(($categorie === 'W' || $categorie === 'P') && $duree > 3) {
        $total *= 0.8; // rabais de 20%
    }

    if($total >= 200) {
        $total *= 0.95; // rabais de 5%
    }
    return $total;
}

