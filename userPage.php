<?php

session_start(); 
require_once 'classes/Tweet.php'; 
require_once 'classes/Users.php'; 
require_once 'classes/Comment.php';   
require_once 'classes/Message.php'; 
require_once 'config.php'; 
?> 

<!DOCTYPE html>
<html lang="pl-PL">
<head>
<meta charset="UTF-8">
<title>Strona uzytkownika</title>
</head>
<body>  
    <a href="glownapo.php">Wróc do strony głównej</a><br><br>

<?php

if(!isset($_SESSION['zalogowany'])) { //zabezpieczenie przed wejsciem z 
    header('Location:index.php');     // wpisujac adres w przegladarce
    exit();  
}  

if(isset($_SESSION['id'])) { 
  $logUser=Users::loadUserById($conn,$_SESSION['id']);  
  $userName=$logUser->getUsername();  
  $senderUserId=$logUser->getId(); 
 
}
    if(isset($_POST['text']) && isset($_POST['userId'])) {
         $text=trim($_POST['text']) ; 
         $recipientUserId=trim($_POST['userId']) ; 
            if(strlen($text)>0 && ($recipientUserId!=$senderUserId) ){   // spr czy ktos nie wysyła sam sobie
                
                $creationDate= date("Y-m-d H:i:s"); 
                $newMessage=new Message();  
                $newMessage->setText($text);   
                $newMessage->setCreationDate($creationDate);  
                $newMessage->setRecipientUserId($recipientUserId);   
                $newMessage->setSenderUserId($senderUserId); 
                //$newMessage->setRead($NewRead);
                $newMessage->saveToDB($conn);
            
            
                    if($newMessage->saveToDB($conn))   {
                    $_SESSION['messageSend']="wiadomość wysłana";   
             
                    } 
                        else{ 
                          echo"Blad podczas wysyłania.";  
                         echo $conn->error;
                        }    
            }
            
    }

echo"Wszystkie Tweety użytkownika:";  
if ($_SERVER['REQUEST_METHOD']=='GET'){ 
        if(isset($_GET['userId'])) {  
           $id=($_GET['userId']) ; 
           $userId=$id;
           $tweets=Tweet::loadTweetsByUserId($conn, $userId);  
             foreach ($tweets as $tweet) {
               echo "<br><br>";
               echo $tweet->getCreationDate(); 
               echo "<br>"; 
               echo $tweet->getText();  
               echo "<br>";  
             } 
        }         
} 
     ?>

 
    <form method="POST">  
        <p>Wyślij mi wiadomość: </p>
        <textarea name="text" cols="70" rows="5"></textarea><br><br> 
          <input type="hidden"name="userId"value="<?php echo $_GET['userId'];?>">
          <input type="submit"value="Wyślij">  <br>
             <?php  
             if(isset($_SESSION['messageSend'])) { 
                echo $_SESSION['messageSend'] ."<br>";
                unset($_SESSION['messageSend']);
             }  
             ?>  
    </form>   
    
</body> 
</html>