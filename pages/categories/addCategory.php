<?php
session_start();
include("../../connexion/connect.php");
//include("../connexion/BDoperations.php");
$bdd = maConnexion();





if (isset($_REQUEST['category_name']) && !empty($_REQUEST['category_name']))
    $category_name = $bdd->quote($_REQUEST['category_name']);



$query = "SELECT * FROM categories WHERE categories.category_name=$category_name";
$reponse = $bdd->query($query) or die($bdd->errorInfo()[2]);
$date = $bdd->quote(date("Y-m-d H:i:s"));
$nblignes = $reponse->rowCount();
if ($nblignes == 0) {

    $query = "INSERT INTO categories (category_name) values ($category_name)";
    $nblignes = $bdd->exec($query);
    if ($nblignes != 1)
        //echo "Impossible d'effectuer la requète!";
        echo "<p>Impossible d'effectuer la requète!" . $bdd->errorInfo()[2] . "</p>";
    else {
        $_SESSION['message']="La catégorie a été ajouté avec succée!";
        header('Location: categories.php');
        exit;
    }
    //  echo "<h3>Utilisateur bien ajouté!</h3>";   

} else {
    echo "Utilisateur existe déjà!";
    //echo "<h3>Utilisateur existe déjà!</h3>";

}



?>