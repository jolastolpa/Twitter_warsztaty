<?php

session_start(); 
require_once 'classes/Tweet.php'; 
require_once 'classes/Users.php'; 
require_once 'classes/Comment.php';  
require_once 'config.php';


if(!isset($_SESSION['zalogowany'])) { //zabezpieczenie przed wejsciem z 
    header('Location:index.php');     // wpisujac adres w przegladarce
    exit();  
}  
if(isset($_SESSION['id'])) {  // wczytywanie uzytkownika
  $logUser=Users::loadUserById($conn,$_SESSION['id']);  
  $userName=$logUser->getUsername();  
  $userId=$logUser->getId(); 
}  
 
//if ($_SERVER['REQUEST_METHOD']=='POST'){ 
    if(isset($_POST['text']) && isset($_POST['tweetId'])){  
         $text=trim($_POST['text']) ; 
         $tweetId=trim($_POST['tweetId']) ; 
        if(strlen($text)>0 && strlen($text<61)) { 
           
            $creationDate= date("Y-m-d H:i:s"); 
            $newComment=new Comment(); 
            $newComment->setText($text);   
            $newComment->setCreationDate($creationDate);  
            $newComment->setUserId($_SESSION['id']); 
            $newComment->setTweetId($tweetId);
            $newComment->saveToDB($conn);
            
             
            if($newComment->saveToDB($conn))   {
               $_SESSION['dodanoComment']="Dodano komentarz";   
             
            } 
              else{ 
                  echo"Blad podczas dodawania."; 
              }
        
        }  
          else { 
              $_SESSION['blad_comment']="Komentarz może mieć od 1 do 60 znaków";
            
          }
    } 
//} 
      

?> 

<!DOCTYPE html>
<html lang="pl-PL">
<head>
<meta charset="UTF-8">
<title>Strona Tweeta</title>
</head>
<body>   
    
    <a href="glownapo.php">Wróc do strony głównej</a>
 
    <?php  
    //if ($_SERVER['REQUEST_METHOD']=='GET'){ 
        if(isset($_GET['idTweet'])) { 
           $id=($_GET['idTweet']) ;
     
           $loadedTweet=Tweet::loadTweetById($conn,$id) ; 
          
         echo "<br><br>";
           echo $loadedTweet->getCreationDate(); 
           echo "<br>"; 
           echo $loadedTweet->getUsername(); 
           echo "<br>"; 
           echo $loadedTweet->getText();  
           echo "<br><br>";  
           
        } 
    //}
           echo "<h3>Komentarze:</h3>";   
           $tweetId=$id ; 
           
           $comments=Comment::loadAllCommentByTweetId($conn, $tweetId);  
                foreach ($comments as $comm) {
                  echo "<br>";
                  echo $comm->getCreationDate(); 
                  echo "<br>"; 
                  echo $comm->getUsername(); 
                  echo "<br>"; 
                  echo $comm->getText();  
                  echo "<br>"; 
    
                }
    ?> 
    
        <form method="POST">  
            <p>Dodaj Komentarz : </p>
              <textarea name="text" cols="40" rows="4"></textarea><br><br> 
                  <?php 
                   if(isset($_SESSION['blad_comment'])) { 
                   echo $_SESSION['blad_comment'] ."<br>";
                   unset($_SESSION['blad_comment']);
                    }  
                   ?> 
               <input type="hidden"name="tweetId"value="<?php echo $_GET['idTweet'];?>">
               <input type="submit"value="Wyślij">  <br>
                  <?php  
                  if(isset($_SESSION['dodanoComment'])) { 
                  echo $_SESSION['dodanoComment'] ."<br>";
                  unset($_SESSION['dodanoComment']);
                  }  
                  ?>  
        </form>
</body> 
</html>