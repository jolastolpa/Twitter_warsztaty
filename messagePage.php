<?php
session_start(); 
require_once 'classes/Tweet.php'; 
require_once 'classes/Users.php'; 
require_once 'classes/Message.php';  
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



// jesli przesłano id wiadomości to wczytaj 
    if ($_SERVER['REQUEST_METHOD']=='GET'){ 
        if(isset($_GET['messId'])) { 
           $id=($_GET['messId']) ;
     
        $message=Message::loadMessageById($conn,$id) ;   
        
        $RecipientUserId=$message->getRecipientUserId();  
        
            if($RecipientUserId=$userId){  // Jesli zalogowany uzytkownik jest odbiorca wiadomosci
                $message->saveToDB($conn); // to wczytaj do bazy wiadomosc jako przeczytaną
               
                echo "Data wysłania:";
                echo $message->getCreationDate(); 
                echo "<br>";  
                echo "Nadawca:";
                echo $message->getSenderUsername(); 
                echo "<br>";   
                echo "Treść:";
                echo $message->getText();  
                
            }   
                else{  
                    echo "Data wysłania:";
                    echo $message->getCreationDate(); 
                    echo "<br>";  
                    echo "Nadawca:";
                    echo $message->getRecipientUsername(); 
                    echo "<br>";   
                    echo "Treść:";
                    echo $message->getText();  
                 
                }
                    
        }
    }