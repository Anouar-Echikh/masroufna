<?php
// Start the session
session_start();

?>


<!DOCTYPE html>
<html>

<head>
  <title>Masroufna</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

  <link rel="stylesheet" href="./css/style.css">
 
</head>

<body>


  <!-- Navigation bar -->
  <nav class="navbar">
    <div class="container">
      <div class="navbar-header d-flex justify-content-between  container"> 
        <a class="navbar-brand" href="#">Masroufna</a> 
        
      <button type="button"  class=" btn btn-link text-white text-bold " data-toggle="modal" data-target="#staticBackdrop" >Se Connecter</button>
    
      </div>
    </div>
  </nav>

  <!-- Jumbotron -->
  <div class="container">
    <div class="jumbotron">
      <img src="./images/logo.jpg" alt="Logo" width="240" height="250">
      <h1 class="m-2">Masroufna</h1>
      <div class="d-flex justify-content-center container">
      <div class="alert alert-primary " style="width:500px; margin-top:20px" role="alert">
      Une application pour vous aider à mieux gérer vos dépenses personnelles et familiales.
      </div>
      </div>

      <div class=" connexion" >
      <p class="m-2 connexion" >Se connecter ou Créer un compte</p>
      <!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#staticBackdrop">
Se Connecter
</button>
<button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#createModal">
Créer un compte
</button>

    
     
    </div>
    </div>

  </div>


<!-- Modal login-->
<div class="modal  fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
  <form method="POST" action="./pages/auth/login.php" name="form1">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Connexion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
  <div class="form-group">
    <label for="exampleInputEmail1">Email:</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Mot de passe:</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Se connecter</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        
      </div>
    </div>
    </form>
  </div>
</div>
<!-- Modal creation-->
<div class="modal  fade" id="createModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
  <form  name="form1">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Créer un compte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <div class="form-group">
    <label for="exampleInputEmail1">Votre nom:</label>
    <input type="nom" name="nom" id="nom" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
    
  </div>
      <div class="form-group">
    <label for="exampleInputEmail1">Email:</label>
    <input type="email" name="email" id="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  required >
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Mot de passe:</label>
    <input type="password" name="password" id="password" class="form-control" id="exampleInputPassword1" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Confirmer votre mot de passe:</label>
    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" id="exampleInputPassword1" required>
  </div>
  <div class="alert alert-danger d-none" id="alert-confirm-password" style="margin:10px" role="alert" ></div>
  </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary" id="submit-signup">Créer</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        
      </div>
    </div>
    </form>
  </div>
</div>
<script>
  // Check if a message is set in the session
  <?php if (isset($_SESSION['message'])): ?>
  
  // Display the message as a toast notification
  
  alert("<?php echo $_SESSION['message']; ?>");

  // Clear the session message
  <?php unset($_SESSION['message']); ?>
  
  <?php endif; ?>
</script>
  <!-- jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>
    <script src="./js/auth.js"> </script>
   

</body>

</html>