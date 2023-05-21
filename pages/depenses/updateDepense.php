<?php
session_start();
 include("../../connexion/connect.php");
 //include("../connexion/BDoperations.php");
 $bdd = maConnexion();



 if (isset($_REQUEST['expense_id']) && !empty($_REQUEST['expense_id']))
 $expense_id = $bdd->quote($_REQUEST['expense_id']);

 if (isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id']))
 $user_id = $bdd->quote($_REQUEST['user_id']);

if (isset($_REQUEST['category_id']) && !empty($_REQUEST['category_id']))
 $category_id = $bdd->quote($_REQUEST['category_id']);


if (isset($_REQUEST['date']) && !empty($_REQUEST['date']))
 $date = $bdd->quote($_REQUEST['date']);

if (isset($_REQUEST['description']) && !empty($_REQUEST['description']))
 $description = $bdd->quote($_REQUEST['description']);

if (isset($_REQUEST['montant']) && !empty($_REQUEST['montant']))
 $montant = $bdd->quote($_REQUEST['montant']);

   
        $query = "UPDATE expenses SET user_id=$user_id,category_id=$category_id,date=$date,description=$description,montant=$montant WHERE expenses.expense_id=$expense_id";
        $nblignes = $bdd->exec($query);
        if ($nblignes != 1)
        //echo "Impossible d'effectuer la requète!";
       echo "<p>Impossible d'effectuer la requète!" . $bdd->errorInfo()[2] . "</p>";
            
        else
        {
            $_SESSION['message']="Dépense modifiée avec succée!";
    
            header('Location: depenses.php');
        exit;
        }
      //  echo "<h3>Utilisateur bien ajouté!</h3>";   
       
   
    ?>




