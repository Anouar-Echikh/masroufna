<?php
//include ('connect.php');



function login($email, $password, $bdd)
{

    $query = "SELECT * FROM users WHERE users.email=$email AND users.password=$password";
    $reponse = $bdd->query($query) or die($bdd->errorInfo()[2]);

    $nblignes = $reponse->rowCount();
    if ($nblignes == 1) {
        $ligne = $reponse->fetchObject();

        session_start();
        $_SESSION['username'] = $ligne->username;
        return true;
    } else {
        // If the username and password are invalid, return false
        return false;
    }
}


?>