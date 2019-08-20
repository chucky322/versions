<?php
$somevar = $_GET["uid"];
session_start();

// Store data in session variables
$_SESSION["loggedin"] = true;
$_SESSION["username"] = $somevar;                            

// Redirect user to welcome page
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1) {
        //session is set
        header('Location: version.php');
    } else if(!isset($_SESSION['loggedin']) || (isset($_SESION['loggedin']) && $_SESSION['loggedin'] == 0)){
        //session is not set
        header('Location: index.php');
    }

?>