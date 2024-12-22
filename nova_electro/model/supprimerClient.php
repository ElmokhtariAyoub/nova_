<?php
session_start(); // Démarre la session si ce n'est pas déjà fait
include 'connexion.php'; // Inclut le fichier de connexion à la base de données




// Vérifie si l'identifiant du client à supprimer est passé en paramètre dans l'URL
if (!empty($_GET['id'])) {
    $id = $_GET['id']; // Récupère l'ID du client à supprimer depuis l'URL

    // Requête SQL pour supprimer le client avec l'ID spécifié
    $sql = "DELETE FROM client WHERE id = ?";
    $req = $connexion->prepare($sql);

    // Exécute la requête en passant l'ID du client comme paramètre
    $req->execute([$id]);

    // Vérifie si la suppression a réussi
    if ($req->rowCount() > 0) {
        $_SESSION['text'] = "Client bien supprimé";
        $_SESSION['type'] = "success";
    } else {
        $_SESSION['text'] = "Une erreur s'est produite lors de la suppression du client";
        $_SESSION['type'] = "danger";
    }
} else {
    $_SESSION['text'] = "ID du client non spécifié";
    $_SESSION['type'] = "danger";
}

// Redirige vers la page des clients après la suppression
header('Location: ../vue/client.php');
?>
