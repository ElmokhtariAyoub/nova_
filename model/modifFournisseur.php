<?php
include 'connexion.php';
if (
    !empty($_POST['nom'])
    && !empty($_POST['prenom'])
    && !empty($_POST['telephone'])
    && !empty($_POST['adresse'])
    && !empty($_POST['id'])
) {

$sql = "UPDATE fournisseur SET nom=?, prenom=?, telephone=?, adresse=? WHERE id=?";
    $req = $connexion->prepare($sql);
    
    $req->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['adresse'],
        $_POST['id']
    ));
    
    if ( $req->rowCount()!=0) {
        $_SESSION['text'] = "fournisseur modifié avec succès";
        $_SESSION['type'] = "success";
    }else {
        $_SESSION['text'] = "Rien a été modifié";
        $_SESSION['type'] = "warning";
    }

} else {
    $_SESSION['text'] ="Une information obligatoire non rensignée";
    $_SESSION['type'] = "danger";
}

header('Location: ../vue/fournisseur.php');