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
if ($_SERVER['REQUEST_METHOD']=='POST'){ 
    if(isset($_POST['usernameEdit']) ||
           ( isset($_POST['haslo1Edit'])&& isset($_POST['haslo2Edit']))) { 
    //zaklam poczatkowo udana walidacje danych
    $walidacja_ok=true ; 
    $usernameEdit=trim($_POST['usernameEdit']);  
    // sprawdzam poprawnosc danych user name
        
        if ((strlen($usernameEdit)<3)|| (strlen($usernameEdit)>20)) { 
           $walidacja_ok=false; 
           $_SESSION['blad_username']="Nickname musi posiadac od 3 do 20 znaków!!!";
        } 
        if (ctype_alnum($usernameEdit)==false) { 
           $walidacja_ok=false; 
           $_SESSION['blad_username2']="Nickname może składac się tylko z liter
                  i cyfr(bez polskich znaków)";
        } 

    $haslo1Edit=trim ($_POST['haslo1Edit']);  
    $haslo2Edit=trim ($_POST['haslo2Edit']);  
    
        if ((strlen($haslo1Edit)<6)|| (strlen($haslo1Edit)>20)) { 
            $walidacja_ok=false; 
            $_SESSION['blad_haslo']="Hasło może posiadać od 6 do 25 znaków";
          
        } 
        if ($haslo1Edit!=$haslo2Edit) {  
            $walidacja_ok=false;  
            $_SESSION['blad_haslo2']="Hasła nie są identyczne";
        } 
        
        
        
        
        if($walidacja_ok==true) { 
               // edycja uzytkownika do bazy 
               
            
            $logUser->setUsername($usernameEdit);  
         
            $logUser->setPassword($haslo1Edit); 
            $logUser->saveToDB($conn);
            
            
            if($logUser->saveToDB($conn))   { 
           
               $_SESSION['udanaEdycja']="Poprawnie zmieniono dane"; 
              
               header('Location:userPage.php');
             
            } else{
                echo"uuups coś poszło nie tak.Spróbuj póżniej";
              } 
        }  
    } 

}


?>   
<!DOCTYPE html>
<html lang="pl-PL">
<head>
<meta charset="UTF-8">
<title>Edycja danych</title>
</head>
<body>
       


<form method="POST">  
        Zmień nickname (od 3 do 20 znaków) <br>
          <input type="text" name="usernameEdit"> <br><br> 
          <?php  
            if(isset($_SESSION['blad_username'])) { 
                echo $_SESSION['blad_username'] ."<br>";
                unset($_SESSION['blad_username']);
            } 
            if(isset($_SESSION['blad_username2'])) { 
                echo $_SESSION['blad_username2'] ."<br>";
                unset($_SESSION['blad_username2']);
            }
          ?> 
      
          
        Zmień hasło(od 6 do 20 znaków) <br> 
          <input type="password" name="haslo1Edit"> <br><br>   
          <?php  
            if(isset($_SESSION['blad_haslo'])) { 
                echo $_SESSION['blad_haslo']."<br>";
                unset($_SESSION['blad_haslo']);
            }
          ?> 
        Powtórz nowe haslo <br> <input type="password" name="haslo2Edit"> <br><br>    
          <?php  
            if(isset($_SESSION['blad_haslo2'])) { 
                echo $_SESSION['blad_haslo2']."<br>";
                unset($_SESSION['blad_haslo2']);
            }
          ?> 
        <input type="submit" value="Zmień dane" ><br><br> 
        <a href="glownapo.php">Powrót do strony głównej</a> 
        
</form> 

</body> 
</html>