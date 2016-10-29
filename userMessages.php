<?php
session_start();
require_once 'config.php'; 
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
<title>Skrzynka pocztowa</title>
</head>
<body>  
    <a href="messagesReceived.php">Skrzynka odbiorcza</a><br><br> 
    <a href="messagesSent.php">Skrzynka nadawcza</a>


