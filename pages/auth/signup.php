<?php
session_start();
include("../../connexion/connect.php");
//include("../connexion/BDoperations.php");
$bdd = maConnexion();


if (isset($_REQUEST['nom']) && !empty($_REQUEST['nom']))
    $nom = $bdd->quote($_REQUEST['nom']);



if (isset($_REQUEST['email']) && !empty($_REQUEST['email']))
    $email = $bdd->quote($_REQUEST['email']);




if (isset($_REQUEST['password']) && !empty($_REQUEST['password'])) {
    $password = $bdd->quote($_REQUEST['password']);
    $password = $bdd->quote(md5($password)); //cryptage mot de passe
}



// ajouterUtilisateur($bdd, $nom,$email, $motDePasse,$bdd->quote(date("Y-m-d H:i:s")) );

$query = "SELECT * FROM users WHERE users.email=$email";
$reponse = $bdd->query($query) or die($bdd->errorInfo()[2]);
$date = $bdd->quote(date("Y-m-d H:i:s"));
$nblignes = $reponse->rowCount();
if ($nblignes == 0) {

    $query = "INSERT INTO users (username,email,password) values ($nom,$email,$password)";
    $nblignes = $bdd->exec($query);
    if ($nblignes != 1)
        //echo "Impossible d'effectuer la requète!";
        echo "<p>Impossible d'effectuer la requète!" . $bdd->errorInfo()[2] . "</p>";
    else {

        $_SESSION['username'] = $nom;
        header('Location: ../dashboard.php');
        exit;
    }
    //  echo "<h3>Utilisateur bien ajouté!</h3>";   

} else {
    echo "Utilisateur existe déjà!";
    //echo "<h3>Utilisateur existe déjà!</h3>";

}

?>