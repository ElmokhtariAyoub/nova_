<?php
include 'entete.php';
// if (empty($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
//     header("Location: login.php");
//     exit;
// }
if (!empty($_GET['id'])) {
    $article = getCommande($_GET['id']);
}

?>


<?php
include 'pied.php';
?>
