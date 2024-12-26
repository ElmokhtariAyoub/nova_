<?php
include 'entete.php';

if (empty($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    header("Location: login.php");
    exit;
}



if (!empty($_GET['id'])) {
    $categorie = getCategorie($_GET['id']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <style>
        .alert {
            padding: 20px;
            color: white;
            margin-bottom: 15px;
        }
        .alert.success {background-color: #4CAF50;} /* Green */
        .alert.danger {background-color: #f44336;} /* Red */
    </style>
    <script>
        function showMessage(message, type) {
            if (message) {
                let alertBox = document.createElement('div');
                alertBox.className = `alert ${type}`;
                alertBox.innerText = message;
                document.body.insertBefore(alertBox, document.body.firstChild);
                setTimeout(() => {
                    alertBox.style.display = 'none';
                }, 3000);
            }
        }
    </script>
</head>
<body>

<?php
if (!empty($_SESSION['text']) && !empty($_SESSION['type'])) {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                showMessage('{$_SESSION['text']}', '{$_SESSION['type']}');
            });
          </script>";
    unset($_SESSION['text']);
    unset($_SESSION['type']);
}
?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifCategorie.php" : "../model/ajoutCategorie.php" ?>" method="post">
                <label for="libelle_categorie">Libelle</label>
                <input value="<?= !empty($_GET['id']) ? $categorie['libelle_categorie'] : "" ?>" type="text" name="libelle_categorie" id="libelle_categorie" placeholder="Veuillez saisir le libellé">
                <input value="<?= !empty($_GET['id']) ? $categorie['id'] : "" ?>" type="hidden" name="id" id="id" >
                <button type="submit">Valider</button>
            </form>
        </div>
        <div class="box">
            <table class="mtable">
                <tr>
                    <th>Libelle categorie</th>
                    <th>Action</th>
                </tr>
                <?php
                $categories = getCategorie();

                if (!empty($categories) && is_array($categories)) {
                    foreach ($categories as $key => $value) {
                ?>
                        <tr>
                            <td><?= $value['libelle_categorie'] ?></td>
                            <td><a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt'></i></a> <a href="../model/supprimerCategorie.php?id=<?= $value['id'] ?>"><i class='bx bx-trash'></i></a></td>
                            
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>

<?php
include 'pied.php';
?>

</body>
</html>
