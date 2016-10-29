<?php 
session_start();    
require_once 'config.php';
require_once 'classes/Users.php' ;

if ($_SERVER['REQUEST_METHOD']=='POST'){ 
    if(isset($_POST['username'])&& isset($_POST['email']) &&
            isset($_POST['haslo1'])&& isset($_POST['haslo2'])) { 
    //zaklam poczatkowo udana walidacje danych
    $walidacja_ok=true ; 
    $username=trim($_POST['username']);  
    // sprawdzam poprawnosc danych user name
        
        if ((strlen($username)<3)|| (strlen($username)>20)) { 
           $walidacja_ok=false; 
           $_SESSION['blad_username']="Nickname musi posiadac od 3 do 20 znaków!!!";
        } 
        if (ctype_alnum($username)==false) { 
           $walidacja_ok=false; 
           $_SESSION['blad_username2']="Nickname może składac się tylko z liter
                  i cyfr(bez polskich znaków)";
        } 
     // sprawdzam poprawnosc email
    $email=trim($_POST['email']); 
    $emailOK=filter_var($email,FILTER_SANITIZE_EMAIL); 
     
        if (filter_var($emailOK,FILTER_VALIDATE_EMAIL)==FALSE ||
           ($emailOK!=$email)) {
            $walidacja_ok=false; 
            $_SESSION['blad_email']="Podaj poprawny adres e-mail";
        } 
    // czy jest juz taki meil ?? 
    
    $result=$conn->query("SELECT * FROM Users WHERE email='$email'"); 
    
        
        if($result->num_rows> 0)  {
           $walidacja_ok=false; 
           $_SESSION['blad_email2']="Istnieje już użytkownik o tym e-mailu";
        }


      // spr poprawnosc hasla
    $haslo1=trim ($_POST['haslo1']);  
    $haslo2=trim ($_POST['haslo2']);  
    
        if ((strlen($haslo1)<6)|| (strlen($haslo1)>20)) { 
            $walidacja_ok=false; 
            $_SESSION['blad_haslo']="Hasło może posiadać od 6 do 25 znaków";
        } 
        if ($haslo1!=$haslo2) {  
            $walidacja_ok=false;  
            $_SESSION['blad_haslo2']="Hasła nie są identyczne";
        } 
        
        
        
        
        if($walidacja_ok==true) { 
               // dodanie uzytkownika do bazy 
               
            $newUser=new Users(); 
            $newUser->setUsername($username);  
            $newUser->setEmail($email); 
            $newUser->setPassword($haslo1); 
            $newUser->saveToDB($conn);
            
            
            if($newUser->saveToDB($conn))   {
               $_SESSION['udanarejestracja']=TRUE; 
               $_SESSION['nowyuzytkownik']=$username;
               header('Location:witam.php');
             
            } else{
                echo"uuups coś poszło nie tak.Spróbuj póżniej";
              } 
        }  
    } 
} 
$conn->close(); 
//$conn-=null;
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
<meta charset="UTF-8">
<title>Rejestracja</title>
</head>
<body>
        
    <form method="POST">  
        Nickname (od 3 do 20 znaków) <br>
          <input type="text" name="username"> <br><br> 
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
        E-mail <br> <input type="text" name="email"> <br><br> 
          <?php  
            if(isset($_SESSION['blad_email'])) { 
                echo $_SESSION['blad_email'] ."<br>";
                unset($_SESSION['blad_email']);
            } 
            if(isset($_SESSION['blad_email2'])) { 
                echo $_SESSION['blad_email2']."<br>";
                unset($_SESSION['blad_email2']);
            }
          ?> 
        Hasło(od 6 do 20 znaków) <br> 
          <input type="password" name="haslo1"> <br><br>   
          <?php  
            if(isset($_SESSION['blad_haslo'])) { 
                echo $_SESSION['blad_haslo']."<br>";
                unset($_SESSION['blad_haslo']);
            }
          ?> 
        Powtórz haslo <br> <input type="password" name="haslo2"> <br><br>    
          <?php  
            if(isset($_SESSION['blad_haslo2'])) { 
                echo $_SESSION['blad_haslo2']."<br>";
                unset($_SESSION['blad_haslo2']);
            }
          ?> 
        <input type="submit" value="Zarejestruj się" >
        
    </form> 
</body>
</html>