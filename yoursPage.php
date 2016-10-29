<?php
session_start();  
require_once 'config.php'; 
require_once 'classes/Tweet.php'; 
require_once 'classes/Users.php';

if(!isset($_SESSION['zalogowany'])) { //zabezpieczenie przed wejsciem z 
    header('Location:index.php');     // wpisujac adres w przegladarce
    exit();  
}  
if(isset($_SESSION['id'])) { 
  $logUser=Users::loadUserById($conn,$_SESSION['id']);  
  $_SESSION['username']=$logUser->getUsername();  
  $userId=$logUser->getId();  
  
}  
?>  
<!DOCTYPE html>
<html lang="pl-PL">
<head>
<meta charset="UTF-8">
<title>Twoje konto</title>
</head>
<body>  
    
<a href="userEdit.php">Edytuj swoje dane</a> <br><br>
 <?php 
    if(isset($_SESSION['udanaEdycja'])) { 
    echo $_SESSION['udanaEdycja']."<br>";
    unset($_SESSION['udanaEdycja']);
    }?>
<a href="userTweets.php">Zobacz swoje Tweety</a><br><br> 
<a href="userMessages.php">Twoja skrzynka pocztowa</a><br><br> 
<a href="userDelete.php">Usuń swoje konto</a> 