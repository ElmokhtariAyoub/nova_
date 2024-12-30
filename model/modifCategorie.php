<?php
include 'connexion.php';
if (
    !empty($_POST['libelle_categorie'])
    && !empty($_POST['id'])
) {

$sql = "UPDATE categorie_article SET libelle_categorie=? WHERE id=?";
    $req = $connexion->prepare($sql);
    
    $req->execute(array(
        $_POST['libelle_categorie'],
        $_POST['id']
    ));
    
    if ( $req->rowCount()!=0) {
        $_SESSION['text'] = "Catégorie modifié avec succès";
        $_SESSION['type'] = "success";
    }else {
        $_SESSION['text'] = "Rien a été modifié";
        $_SESSION['type'] = "warning";
    }

} else {
    $_SESSION['text'] ="Une information obligatoire non rensignée";
    $_SESSION['type'] = "danger";
}

header('Location: ../vue/categorie.php');