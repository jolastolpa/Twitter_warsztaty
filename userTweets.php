<?php 
session_start();  
require_once 'config.php'; 
require_once 'classes/Tweet.php'; 
require_once 'classes/Users.php';

if(!isset($_SESSION['zalogowany'])) { //zabezpieczenie przed wejsciem z 
    header('Location:index.php');     // wpisujac adres w przegladarce
    exit();  
}  
if(isset($_SESSION['id'])) {          // ladowanie zalogowanego uzytkownika
  $logUser=Users::loadUserById($conn,$_SESSION['id']);  
  $userName=$logUser->getUsername();  
  $userId=$logUser->getId();  
  
}  ?> 

<!DOCTYPE html>
<html lang="pl-PL">
<head>
<meta charset="UTF-8">
<title>Twoje Tweety</title>
</head>
<body> 
    <a href="glownapo.php">Powrót do strony głównej</a> <br><br>
<?php
echo $userName." to Twoje Tweety:"."<br>";
$tweets=Tweet::loadTweetsByUserId($conn, $userId); 
     foreach ($tweets as $tweet) {
           echo "<br><br>";
           echo $tweet->getCreationDate(); 
           echo "<br>"; 
           echo $tweet->getText();  
           echo "<br><br>";  
     }  
?> 
<
</body> 
</html> 