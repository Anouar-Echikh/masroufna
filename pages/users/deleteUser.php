<?php
session_start();
 include("../../connexion/connect.php");
 //include("../connexion/BDoperations.php");
 $bdd = maConnexion();


if (isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id']))
    $user_id = $bdd->quote($_REQUEST['user_id']);
    

   
        $query = "DELETE FROM users  WHERE users.user_id=$user_id";
        $nblignes = $bdd->exec($query);
        if ($nblignes != 1)
        //echo "Impossible d'effectuer la requète!";
       echo "<p>Impossible d'effectuer la requète!" .$bdd->errorInfo()[2] . "</p>";
            
        else
        {
            $_SESSION['message']="Utilisateur supprimé avec succée!";
    
            header('Location: users.php');
        exit;
        }
      //  echo "<h3>Utilisateur bien ajouté!</h3>";   
       
   
    ?>




