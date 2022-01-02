<?php
//il arrive parfois que l'on veuille ouvrire la session avant le header d'ou le test
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//definition de l'url utile pour la redirection dans action.php
$_SESSION['URL']=$_SERVER['REQUEST_URI']

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>SLAM 4 - DM Roles</title>
    <link href="https://fonts.googleapis.com/css?family=Sanchez" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
</head>
