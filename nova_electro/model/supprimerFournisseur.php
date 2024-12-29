<?php
session_start();
include 'connexion.php';

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM fournisseur WHERE id=?";
    $req = $connexion->prepare($sql);
    $req->execute([$id]);

    if ($req->rowCount() != 0) {
        $_SESSION['text'] = "Fournisseur supprimé avec succès";
        $_SESSION['type'] = "success";
    } else {
        $_SESSION['text'] = "Le fournisseur n'a pas pu être supprimé";
        $_SESSION['type'] = "warning";
    }
} else {
    $_SESSION['text'] = "ID de fournisseur manquant";
    $_SESSION['type'] = "danger";
}

header('Location: ../vue/fournisseur.php');
