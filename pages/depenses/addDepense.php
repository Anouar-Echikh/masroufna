<?php
session_start();
include("../../connexion/connect.php");
//include("../connexion/BDoperations.php");
$bdd = maConnexion();


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


// $query = "SELECT * FROM expenses WHERE expenses.description=$description";
// $reponse = $bdd->query($query) or die($bdd->errorInfo()[2]);
// $date = $bdd->quote(date("Y-m-d H:i:s"));
// $nblignes = $reponse->rowCount();
//if ($nblignes == 0) {

    $query = "INSERT INTO expenses (user_id,category_id,date,description,montant) values ($user_id,$category_id,$date,$description,$montant)";
    $nblignes = $bdd->exec($query);
    if ($nblignes != 1)
        //echo "Impossible d'effectuer la requète!";
        echo "<p>Impossible d'effectuer la requète!" . $bdd->errorInfo()[2] . "</p>";
    else {
        $_SESSION['message'] = "La dépense a été ajoutée avec succée!";
        header('Location: expenses.php');
        exit;
    }
    

?>