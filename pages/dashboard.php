<?php
// Start the session
session_start();

// Check if the username is set in the session
if (isset($_SESSION['username'])) {
  // If the username is set, get it from the session
  $username = $_SESSION['username'];
  //efine($USER,$username)
} else {
  // If the username is not set, redirect the user to the login page
  header('Location: ../index.php');
  exit;
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <!-- Navigation bar -->
  <nav class="navbar">
    <div class="container">
      <div class="navbar-header d-flex justify-content-between  container"> 
        <a class="navbar-brand" href="#">Masroufna</a> 
        
  
      <a class="text-white text-bold" href="logout.php">Logout</a>
    
      </div>
    </div>
  </nav>

  <!-- Jumbotron -->
  <div class="container">
  
    <div class="jumbotron">
    <h2 class="" style="margin-bottom:50px;margin-top:20px;"><?php echo "Bienvenue, ". $_SESSION['username']."!";   ?></h2>
      
     
      <div class="d-flex justify-content-center flex-wrap container">
      
      
      <a href="./users/users.php"><div class="card m-2" style="width: 12rem;">
  <img src="../images/users.png" class="card-img-top" alt="Utilisateurs">
  <div class="card-body">
    <p class="card-text">Utilisateurs</p>
  </div>
</div>
</a>
<a href="./categories/categories.php">
  <div class="card m-2" style="width: 12rem;">
  <img src="../images/categories.png" class="card-img-top" alt="Catégories">
  <div class="card-body">
    <p class="card-text">Catégories</p>
  </div>
</div>
</a>
<a href="./depenses/depenses.php">
  <div class="card m-2" style="width: 12rem;">
  <img src="../images/depenses.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <p class="card-text">Dépenses</p>
  </div>
</div>
</a>

      </div>

      <div class=" connexion" >
      
     
    </div>
    </div>

  </div>


  <!-- jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>

</body>

</html>