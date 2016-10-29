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
  $userName=$logUser->getUsername();  
  $id=$logUser->getId();  
 
}   
if ($_SERVER['REQUEST_METHOD']=='POST'){ 
    if(isset($_POST['usun'])){  
        
        $logUser->delete($conn);  
        
       if($logUser->delete($conn)==TRUE) { 
        
        $_SESSION['usunieto']="Konto zostało usunięte" ; 
        unset($_SESSION['zalogowany']);
           header('location:index.php');   
       } 
    } 
} 
?> 


<!DOCTYPE html>
<html lang="pl-PL">
<head>
<meta charset="UTF-8">
<title>Usuwanie</title>
</head>
<body> 

    <form method="POST">  
        <p><?php echo $userName ; ?> na pewno chcesz usunąć konto?? : </p>
        
        <input type="submit"name="usun" value="TAK">  <br><br>
        <a href="glownapo.php">Wolę wrócić do strony głównej</a>
      </form>
