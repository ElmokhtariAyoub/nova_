<?php
include 'entete.php';
if (empty($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    header("Location: login.php");
    exit;
}


?>

<?php
include 'pied.php';
?>

