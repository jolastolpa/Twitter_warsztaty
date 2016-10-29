

<!DOCTYPE html>
<html lang="pl-PL">
<head>
<meta charset="UTF-8">
<title>Skrzynka odbiorcza</title>
</head>
<body>  

<?php

session_start();
require_once 'config.php'; 
require_once 'classes/Users.php'; 
require_once 'classes/Message.php';

if(!isset($_SESSION['zalogowany'])) { //zabezpieczenie przed wejsciem z 
    header('Location:index.php');     // wpisujac adres w przegladarce
    exit();  
}  
if(isset($_SESSION['id'])) { 
  $logUser=Users::loadUserById($conn,$_SESSION['id']);  
  $userName=$logUser->getUsername();  
  $userId=$logUser->getId();   
} 
  
  echo $userName." to Twoje otrzymane wiadomości:<br>";  
  
  $Messages=Message::loadMessagesByRecipientUserId($conn,$userId);
      foreach ($Messages as $mess) { 
           $id=$mess->getId(); 
           $messId=$id;
           $tresc=$mess->getText(); 
           echo "<br>";
           echo $mess->getCreationDate(); 
           echo "<br>"; 
           echo $mess->getSenderUsername(); 
           echo "<br>"; 
           echo "<a href=messagePage.php?messId=$id'>substr($tresc,0,30);</a>";
           echo "<br>"; 
    
      }
 
?>   
