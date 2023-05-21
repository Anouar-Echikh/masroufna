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
    <h2 class="" style="margin-bottom:50px;margin-top:20px;">Dépenses</h2>
    <img src="../../images/depenses.jpg" class="rounded" alt="Dépenses" width="150" height="150">
     

      <div style="margin-top:40px" class="container ">
      <div class="full-container d-flex justify-content-center ">
      <?php if (isset($_SESSION['message'])): ?>
  
    <div class="alert alert-success " id="alert-confirm-password" style="margin:10px" role="alert" ><?php echo $_SESSION['message']; ?></div>
 
  <?php unset($_SESSION['message']); ?>
  
  <?php endif; ?>
     
      </div>
      <div class="full-container d-flex justify-content-start ">
      <button type="button" id="btn-addExpense" class="btn btn-success my-2" data-toggle="modal" data-target="#addExpenseModal" >+ Ajouter</button>
      </div>
      <table id="depensesTable"  class="table table-bordered">
  <thead>
    <tr>
    <th scope="col" style="width:220px">Options</th>
      <th scope="col" style="width:70px">#</th>
      <th scope="col" style="width:120px">Date</th>
      <th scope="col">Description</th>
      <th scope="col" style="width:120px">Montant</th>
      <th scope="col" class="d-none" >user_idExp</th>
      <th scope="col" class="d-none" >category_idExp</th>
      
      
      
    </tr>
  </thead>
  <tbody>
<?php
  include("../../connexion/connect.php");
// Appel de la fonction de connexion
$bdd = maConnexion();
/*Exécution de la requête de sélection et récupération du résultat
dans $response */
$response = $bdd->query('SELECT * FROM expenses') or die($bdd->errorInfo()[2]);
// Affichage du Expense_namebre d’inscriptions
$nblignes = $response->rowCount();

if($nblignes>0){
  $ligne = $response->fetchObject();
do{
?>

    <tr>
    <td>
      <button type="button" id="btn-updateExpense"  data-id="<?=$ligne->expense_id; ?>" class=" editBtn-exp btn  text-white text-bold btn-sm btn-primary mx-1"  >Modifier</button>
      <button type="button" id="btn-deleteExpense"  data-id="<?=$ligne->expense_id; ?>"  class=" deleteBtn-exp btn  text-white text-bold btn-sm btn-danger mx-1"  >Supprimer</button>
    </td>
       <td> <?=$ligne->expense_id; ?></td>
		   <td> <?=$ligne->date; ?></td>
		   <td> <?=$ligne->description; ?></td>
		   <td> <?=$ligne->montant; ?></td>
		   <td class="d-none"> <?=$ligne->user_id; ?></td>
		   <td class="d-none"> <?=$ligne->category_id; ?></td>
		  
		    
    </tr>
<?php
}while ($ligne = $response->fetchObject());// fin do-while

$response->closeCursor();
//fermer la connexion
$bdd=null;?>
<tr>
      
      <td colspan="4" style="font-weight:bold;">Total</td>
      <td style="font-weight:bold;">
<?php
$bdd = maConnexion();
$response = $bdd->query('SELECT SUM(montant) AS total_sum FROM expenses');
// Affichage du Expense_nombre d’inscriptions

if ($response->rowCount() > 0) {
  $ligne = $response->fetchObject();
  $totalSum = $ligne->total_sum;
  echo $totalSum;
} else {
  echo "0.00";
}


$bdd=null;?>

      </td>
    </tr>
    <?php 
    
  }else{
  echo" <tr> <td colspan='5' style='font-weight:bold;'>Vide!</td></tr>";
  }
    ?>
  </tbody>
</table>
      

      </div>

      
    </div>

  </div>

<!-- Modal ajouter Utilisateurs-->
<div class="modal  fade" id="addExpenseModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
  <form  name="formUdateUser">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Ajouter des dépenses</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
      <div class="form-group">
    <label for="exampleInputEmail1">Catégorie:</label>
    <?php 
$bdd = maConnexion();
  $query = "SELECT * FROM categories";
  $reponse = $bdd->query($query) or die ($bdd->errorInfo()[2]);
  echo "<select name='category_idExp' id='category_idExp' class='form-control'>";
  while($ligne=$reponse->fetchObject()){
      echo "<option value='".$ligne->category_id."'>".$ligne->category_name."</option>";
  }
  echo "</select>";
 ?>        
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Date:</label>
    <input type="date" name="dateExp" id="dateExp" class="form-control"  aria-describedby="emailHelp" pattern="\d{4}/\d{2}/\d{2}" required>
    

    
  </div>
      <div class="form-group">
    <label for="exampleInputEmail1">Description:</label>
    <input type="text" name="description" id="description" class="form-control"  aria-describedby="descriptionHelp"  required >
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Montant:</label>
    <input type="text" name="montant" id="montant" class="form-control"  aria-describedby="montantHelp"  required >
    
  </div>
  <div class="form-group">
   
    <input type="text" name="user_idExp" id="user_idExp" value="<?php if (isset($_SESSION['user_id'])) echo $_SESSION['user_id'];  ?>" class="form-control d-none"  >
  </div>


    </div>
      <div class="modal-footer">
      <button type="submit" id="submit-addExpense" class="btn btn-primary">Ajouter</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        
      </div>
    </div>
    </form>
  </div>
</div>
<!-- fin Modal ajouter depenses-->



<!-- Modal modifier depenses-->
<div class="modal  fade" id="updateExpenseModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
  <form  name="formUpdateDepense">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modifier des dépenses</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
      <div class="form-group">
    <label for="exampleInputEmail1">Catégorie:</label>
    <?php 
$bdd = maConnexion();
  $query = "SELECT * FROM categories";
  $reponse = $bdd->query($query) or die ($bdd->errorInfo()[2]);
  echo "<select  id='update-category_idExp' class='form-control'>";
  while($ligne=$reponse->fetchObject()){
      echo "<option value='".$ligne->category_id."'>".$ligne->category_name."</option>";
  }
  echo "</select>";
 ?>        
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Date:</label>
    <input type="date"  id="update-dateExp"  class="form-control"  aria-describedby="dateHelp" pattern="\d{4}/\d{2}/\d{2}" required>
      
  </div>
      <div class="form-group">
    <label for="exampleInputEmail1">Description:</label>
    <input type="text" name="update-description" id="update-description" class="form-control"  aria-describedby="descriptionHelp"  required >
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Montant:</label>
    <input type="text" name="update-montant" id="update-montant" class="form-control"  aria-describedby="montantHelp"  required >
    
  </div>
  <div class="form-group">
   
    <input type="text" name="update-user_idExp" id="update-user_idExp" value="<?php if (isset($_SESSION['user_id'])) echo $_SESSION['user_id'];  ?>" class="form-control d-none"  >
    <input type="text" name="update-expense_idExp" id="update-expense_idExp"  class="form-control d-none"  >
  </div>


    </div>
      <div class="modal-footer">
      <button type="submit" id="submit-updateExpense" class="btn btn-primary">Modifier</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        
      </div>
    </div>
    </form>
  </div>
</div>
<!-- fin Modal modifier Dépenses-->



<!-- Modal supprimer Utilisateurs-->
<div class="modal  fade" id="deleteDepenseModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
  <form  name="formDeleteUser">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Supprimer une dépenses</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <!-- <input type="email" name="email" id="email" class="form-control"  aria-describedby="emailHelp" >
      <input type="text" name="Expense_id" id="Expense_id" class="form-control"  style="visibility: hidden;"> -->
      
      <span>Voulez-vous vraiment supprimer la dépense :<br>
       <span id="spanDepenseDescription" style="font-weight:bold" ></span>?
      </span>
      <span   id="spanDepense_id" style="visibility: hidden;"></span>  
    
  </div>
  
  
      <div class="modal-footer">
      <button type="button" id="submit-deleteExpense" class="btn btn-primary">Oui</button>
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
    <script src="../../js/depenses.js"> </script>
</body>

</html>