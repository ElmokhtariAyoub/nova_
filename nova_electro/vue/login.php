<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "nova_electro";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Login
if(isset($_POST['nom'])) {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $mdp = mysqli_real_escape_string($conn, $_POST['mdp']);

    $sql = "SELECT * FROM admin WHERE nom='$nom' AND mdp='$mdp'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1) {
        $_SESSION['admin_authenticated'] = true;
        $_SESSION['admin_nom'] = $nom;
        header("Location: client.php");
        exit();
    } else {
        $_SESSION['login_error'] = "Login failed. Invalid username or password.";
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login & Registration Form</title>
  <!---Custom CSS File--->
  <link rel="stylesheet" href="../public/css/Login.css?v3" />
</head>
<body>
  <div class="container">
    <input type="checkbox" id="check">
    <div class="login form">
      <header>Login</header>
      <form action="#" method="POST">
        <input type="text" name="nom" placeholder="Enter your nom">
        <input type="password" name="mdp" placeholder="Enter your password">
        <input type="submit" name="login" class="button" value="Login">
      </form>
      
    </div>
    
  </div>
</body>
</html>
