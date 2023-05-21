<?php
session_start();
//include "../../connexion/BDoperations.php";
include "../../connexion/connect.php";

error_reporting(0);
ini_set('display_errors', 0);

$bdd=maConnexion();

function login($email, $password, $bdd)
{

    $query = "SELECT * FROM users WHERE users.email=$email AND users.password=$password";
    $reponse = $bdd->query($query) or die($bdd->errorInfo()[2]);

    $nblignes = $reponse->rowCount();
    if ($nblignes == 1) {
        $ligne = $reponse->fetchObject();

        session_start();
        $_SESSION['username'] = $ligne->username;
        $_SESSION['user_id'] = $ligne->user_id;
        return true;
    } else {
        // If the username and password are invalid, return false
        return false;
    }
}

if (isset($_REQUEST['email']) && !empty($_REQUEST['email']))
$email=$bdd->quote($_REQUEST['email']);

if (isset($_REQUEST['password']) && !empty($_REQUEST['password']))
    {$password = $bdd->quote($_REQUEST['password']);
    $password =$bdd->quote(md5($password));//cryptage mot de passe
    }


/*echo "
<UL>
<LI>email: $email</LI>
<LI>password: $password</LI>

</UL>";*/
if(isset($email) && isset($password)){
if (login($email, $password,$bdd)) {
  // If login succeeds, redirect to the home page or some other page
  header('Location: ../dashboard.php');
  exit;
} else {

  $_SESSION['message']="Utilisateur introuvable!";
    header('Location: ../../index.php');
  // If login fails, display an error message
  //echo 'Invalid username or password';
}
}
?>