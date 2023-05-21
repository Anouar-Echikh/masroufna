<?php
session_start();
 include("../../connexion/connect.php");
 //include("../connexion/BDoperations.php");
 $bdd = maConnexion();


if (isset($_REQUEST['category_name']) && !empty($_REQUEST['category_name']))
    $category_name = $bdd->quote($_REQUEST['category_name']);



if (isset($_REQUEST['category_id']) && !empty($_REQUEST['category_id']))
    $category_id = $bdd->quote($_REQUEST['category_id']);
    

   
        $query = "UPDATE categories set category_name=$category_name WHERE categories.category_id=$category_id";
        $nblignes = $bdd->exec($query);
        if ($nblignes != 1)
        //echo "Impossible d'effectuer la requète!";
       echo "<p>Impossible d'effectuer la requète!" . $bdd->errorInfo()[2] . "</p>";
            
        else
        {
            $_SESSION['message']="Catégorie modifiée avec succée!";
    
            header('Location: categories.php');
        exit;
        }
      //  echo "<h3>Utilisateur bien ajouté!</h3>";   
       
   
    ?>




