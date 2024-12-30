<?php
session_start();
include 'connexion.php';

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM categorie_article WHERE id=?";
    $req = $connexion->prepare($sql);
    $req->execute([$id]);

    if ($req->rowCount() != 0) {
        $_SESSION['text'] = "Catégorie supprimée avec succès";
        $_SESSION['type'] = "success";
    } else {
        $_SESSION['text'] = "La catégorie n'a pas pu être supprimée";
        $_SESSION['type'] = "warning";
    }
} else {
    $_SESSION['text'] = "ID de catégorie manquant";
    $_SESSION['type'] = "danger";
}

header('Location: ../vue/categorie.php');
