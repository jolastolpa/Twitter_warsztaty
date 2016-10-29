<?php 
session_start();  
if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)) { 
    header('Location:glownapo.php'); 
    exit(); 
} 
if(isset($_SESSION['usunieto'])) 
    echo $_SESSION['usunieto']; 
    unset($_SESSION['usunieto']);
?>


<!DOCTYPE html>
<html lang="pl-PL">
<head>
<meta charset="UTF-8">
<title>Twitter</title>
</head>
<body>
    <h1> TWITTER </h1>
    <h2> <a href="rejestracja.php">Rejestracja-załóż konto</a> </h2>
    <br> <br> 
    <h3>Jeśli już masz konto, zaloguj się: </h3><br>
        <form action="zaloguj.php" method="POST"> 
        Email <br> <input type="text" name="email"> <br><br>
        Hasło <br> <input type="password" name="haslo1"> <br><br>  
             <input type="submit" value="Zaloguj się" >
        
    </form> 
    
<?php
    if (isset ($_SESSION['blad'] )) 
        echo $_SESSION['blad']; 
        unset($_SESSION['blad'])
    
?>
    
    
    
    
</body>
</html>