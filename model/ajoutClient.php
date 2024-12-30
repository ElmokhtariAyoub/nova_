<?php
include 'connexion.php';
if (
    !empty($_POST['nom'])
    && !empty($_POST['prenom'])
    && !empty($_POST['telephone'])
    && !empty($_POST['adresse'])
) {

$sql = "INSERT INTO client(nom, prenom, telephone, adresse)
        VALUES(?, ?, ?, ?)";
    $req = $connexion->prepare($sql);
    
    $req->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['adresse']
    ));
    
    if ( $req->rowCount()!=0) {
        $_SESSION['text'] = "client ajouté avec succès";
        $_SESSION['type'] = "success";
    }else {
        $_SESSION['text'] = "Une erreur s'est produite lors de l'ajout du client";
        $_SESSION['type'] = "danger";
    }

} else {
    $_SESSION['text'] ="Une information obligatoire non rensignée";
    $_SESSION['type'] = "danger";
}

header('Location: ../vue/client.php');