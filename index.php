<?php
include 'conn.php';
?>
<?php
// Database connection


// Login
if (isset($_POST['nom'], $_POST['mdp'])) {
  $nom = $_POST['nom'];
  $mdp = $_POST['mdp'];

  // Use a prepared statement to avoid SQL injection
  $sql = "SELECT * FROM admin WHERE nom = :nom AND mdp = :mdp";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':nom', $nom);
  $stmt->bindParam(':mdp', $mdp);

  $stmt->execute();

  // Check if the user exists
  if ($stmt->rowCount() > 0) {
      header("Location: client.php");
      exit();
  } else {
      // Avoid headers after output; redirect with JavaScript as a fallback
      echo "<script>alert('Login failed. Invalid nom or mdp'); window.location.href='index.php';</script>";
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
  <link rel="stylesheet" href="../public/css/style2.css?v1" />
</head>
<body>
  <div class="container">
    <input type="checkbox" id="check">
    <div class="login form">
      <header>Login</header>
      <form action="index.php" method="POST">
        <input type="text" name="nom" placeholder="Enter your nom">
        <input type="password" name="mdp" placeholder="Enter your password">
        <input type="submit" name="login" class="button" value="Login">
      </form>
      
    </div>
    
  </div>
</body>
</html>
