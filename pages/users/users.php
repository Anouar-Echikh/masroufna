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
  header('Location: ../../index.php');
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

  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../js/toast/jquery.toast.min.css">
</head>

<body>
  <!-- Navigation bar -->
  <nav class="navbar">
    <div class="container">
      <div class="navbar-header d-flex justify-content-between  container"> 
        <a class="navbar-brand" href="../../index.php">Masroufna</a> 
        
  <span>
      <span class="text-white text-bold mx-2" ><?php echo "Bienvenue, ". $_SESSION['username']."!";   ?></span>
      <a class="text-white text-bold" href="../auth/logout.php">Logout</a>
  </span>
      </div>
    </div>
  </nav>

  <!-- Jumbotron -->
  <div class="container">
  
    <div class="jumbotron">
    <h2 class="" style="margin-bottom:50px;margin-top:20px;">Utilisateurs</h2>
    <img src="../../images/users.png" class="rounded" alt="Dépenses" width="150" height="150">
     

      <div style="margin-top:40px" class="container ">
      <div class="full-container d-flex justify-content-center ">
      <?php if (isset($_SESSION['message'])): ?>
  
    <div class="alert alert-success " id="alert-confirm-password" style="margin:10px" role="alert" ><?php echo $_SESSION['message']; ?></div>
 
  <?php unset($_SESSION['message']); ?>
  
  <?php endif; ?>
     
      </div>
      <table id="usersTable"  class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Email</th>
      <th scope="col">Options</th>
      
    </tr>
  </thead>
  <tbody>
<?php
  include("../../connexion/connect.php");
// Appel de la fonction de connexion
$bdd = maConnexion();
/*Exécution de la requête de sélection et récupération du résultat
dans $response */
$response = $bdd->query('SELECT * FROM users') or die($bdd->errorInfo()[2]);
// Affichage du nombre d’inscriptions
$ligne = $response->fetchObject();

do{
?>

    <tr>
       <td> <?=$ligne->user_id; ?></td>
		   <td> <?=$ligne->username; ?></td>
		   <td> <?=$ligne->email; ?></td>
       <td>
      <button type="button" id="btn-updateUser" data-id="<?=$ligne->user_id; ?>" class=" editBtn btn  text-white text-bold btn-sm btn-primary mx-1"  >Modifier</button>
      <button type="button" id="btn-deleteUser" data-id="<?=$ligne->user_id; ?>"  class=" deleteBtn btn  text-white text-bold btn-sm btn-danger mx-1"  >Supprimer</button>
    </td>
    </tr>
<?php
}while ($ligne = $response->fetchObject());// fin do-while
$response->closeCursor();
//fermer la connexion
$bdd=null;?>

    
  </tbody>
</table>
      

      </div>

      
    </div>

  </div>
<!-- Modal modifier Utilisateurs-->
<div class="modal  fade" id="updateUserModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
  <form  name="formUdateUser">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modifier un utilisateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
      <div class="form-group">
    <label for="exampleInputEmail1">Votre nom:</label>
    <input type="text" name="nom" id="nom" class="form-control"  aria-describedby="emailHelp" required>
    
  </div>
      <div class="form-group">
    <label for="exampleInputEmail1">Email:</label>
    <input type="email" name="email" id="email" class="form-control"  aria-describedby="emailHelp"  required >
    
  </div>
  <div class="form-group">
   
    <input type="text" name="user_id" id="user_id" class="form-control"  style="visibility: hidden;">
  </div>
  
    </div>
      <div class="modal-footer">
      <button type="submit" id="submit-updateUser" class="btn btn-primary">Modifier</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        
      </div>
    </div>
    </form>
  </div>
</div>
<!-- fin Modal modifier Utilisateurs-->



<!-- Modal supprimer Utilisateurs-->
<div class="modal  fade" id="deleteUserModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
  <form  name="formDeleteUser">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Supprimer un utilisateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <!-- <input type="email" name="email" id="email" class="form-control"  aria-describedby="emailHelp" >
      <input type="text" name="user_id" id="user_id" class="form-control"  style="visibility: hidden;"> -->
      
      <span>Voulez-vous vraiment supprimer  <span id="spanUserName" style="font-weight:bold" ></span>?</span>
      <span   id="user_id" style="visibility: hidden;"></span>  
    
  </div>
  
  
      <div class="modal-footer">
      <button type="button" id="submit-deleteUser" class="btn btn-primary">Oui</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        
      </div>
    </div>
    </form>
  </div>
</div>
<!-- fin Modal supprimer Utilisateurs-->



  <!-- jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../../js/toast/jquery.toast.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>
    <script src="../../js/users.js"> </script>
</body>

</html>