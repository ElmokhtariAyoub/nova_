<?php
include 'connexion.php';

if (!empty($_POST['libelle_categorie'])) {
    $sql = "INSERT INTO categorie_article(libelle_categorie) VALUES(?)";
    $req = $connexion->prepare($sql);
    $req->execute(array($_POST['libelle_categorie']));

    if ($req->rowCount() != 0) {
        $_SESSION['text'] = "Catégorie a été bien ajoutée";
        $_SESSION['type'] = "success";
    } else {
        $_SESSION['text'] = "Une erreur s'est produite lors de l'ajout du catégorie";
        $_SESSION['type'] = "danger";
    }
} else {
    $_SESSION['text'] = "Une information obligatoire non renseignée";
    $_SESSION['type'] = "danger";
}

header('Location: ../vue/categorie.php');
?>
