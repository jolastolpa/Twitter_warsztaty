<?php

session_start();  

if(!isset($_SESSION['udanarejestracja'])) { // zabezpieczenie gdyby ktos wpisal 
    header('Location:index.php');          // witam.php do przegladarki bez rejestracji
    exit(); 
} else { 
    unset($_SESSION['udanarejestracja']);
  } 
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
<meta charset="UTF-8">
<title>Witamy</title>
</head>
<body>
    Dziękujemy <strong> <?php  echo $_SESSION['nowyuzytkownik'] ;  ?> </strong>
    za rejestracje w serwisie .
    Możesz się już zalogowac:<br><br>
    <a href="index.php">Zaloguj się na swoje konto</a> 
    <br> 
    
    
</body> 
</html>
