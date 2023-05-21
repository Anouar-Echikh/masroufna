<?php
session_start();
include("../../connexion/connect.php");
//include("../connexion/BDoperations.php");
$bdd = maConnexion();


if (isset($_REQUEST['expense_id']) && !empty($_REQUEST['expense_id']))
    $expense_id = $bdd->quote($_REQUEST['expense_id']);
    


$query = "DELETE FROM expenses  WHERE expenses.expense_id=$expense_id";
$nblignes = $bdd->exec($query);
if ($nblignes != 1)
    //echo "Impossible d'effectuer la requète!";
    echo "<p>Impossible d'effectuer la requète!" . $bdd->errorInfo()[2] . "</p>";
else {
    //$_SESSION['message'] = "Catégorie supprimé avec succée!";

     //header('Location: categories.php');
   exit;
}
//  echo "<h3>Utilisateur bien ajouté!</h3>";   


?>