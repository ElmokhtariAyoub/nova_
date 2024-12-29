<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$nom_serveur = "localhost:8082";
$nom_base_de_donne = "nova_electro";
$utilisateur = "root";
$motpass = "";

try {
    $connexion = new PDO("mysql:host=$nom_serveur;dbname=$nom_base_de_donne", $utilisateur, $motpass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $connexion;
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

