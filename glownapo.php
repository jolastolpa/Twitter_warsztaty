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
  $userName=$logUser->getUsername();  
  $userId=$logUser->getId(); 
} 


if ($_SERVER['REQUEST_METHOD']=='POST'){ 
    if(isset($_POST['text'])) { 
         $text=trim($_POST['text']) ;
        if(strlen($text)>0 && strlen($text<141)) { 
            
            $creationDate= date("Y-m-d H:i:s"); 
            $newTweet=new Tweet(); 
            $newTweet->setText($text);   
            $newTweet->setCreationDate($creationDate);  
            $newTweet->setUserId($_SESSION['id']);  
            $newTweet->saveToDB($conn);
            
             
            if($newTweet->saveToDB($conn))   {
               $_SESSION['dodanoTweet']="Dodano Tweeta";   
             
            } 
              else{ 
                  echo"Blad podczas dodawania."; 
              }
        
        }  
          else { 
              $_SESSION['blad_strlen']="Tweet może mieć od 1do 140 znaków";
            
          }
    } 
}
        

?> 

<!DOCTYPE html>
<html lang="pl-PL">
<head>
<meta charset="UTF-8">
<title>Twitter</title>
</head>
<body> 

  <h1><strong> Witaj <?php echo $userName; ?> ! </strong> </h1> 
  [<a href="logout.php">Wyloguj się</a>] <br><br>  
  <h2><a href="yoursPage.php">Twoje konto</a> </h2> <br><br>
      
    
      <form method="POST">  
        <p>Dodaj Tweeta : </p>
        <textarea name="text" cols="40" rows="4"></textarea><br><br> 
          <?php 
            if(isset($_SESSION['blad_strlen'])) { 
                echo $_SESSION['blad_strlen'] ."<br>";
                unset($_SESSION['blad_strlen']);
            }  
          ?>
        <input type="submit"value="Wyślij">  <br>
          <?php  
            if(isset($_SESSION['dodanoTweet'])) { 
                echo $_SESSION['dodanoTweet'] ."<br>";
                unset($_SESSION['dodanoTweet']);
            }  
          ?>  
      </form> <br> 
        <p> WSZYSTKIE TWEETY NASZYCH UŻYTKOWNIKÓW: </p> 
    <?php   
       $allTweets=Tweet::loadAllTweets( $conn); 
       foreach ($allTweets as $tweet) {
           echo "<br><br>";
           echo $tweet->getCreationDate(); 
           echo "<br>"; 
           //echo $tweet->getUsername();  
           $username=$tweet->getUsername();
           $userId=$tweet->getUserId();
           $id=$userId;
           echo "<a href='userPage.php?userId=$id'>$username; </a>";
           echo "<br>"; 
           echo $tweet->getText();  
           echo "<br>"; 
           $id=$tweet->getId();  
           $idTweet=$id;
           echo "<a href='TweetPage.php?idTweet=$id'>Dodaj komentarz</a>"; 
       } 
       ?>
    
    
    
</body>
</html>