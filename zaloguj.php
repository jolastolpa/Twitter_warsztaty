<?php
session_start();  
require_once 'config.php';  
require_once 'classes/Users.php'; 

// strona niewidoczna dla użytkownia.tylko do weryfikacjii

if((!isset($_POST['email'])) || (!isset($_POST['haslo1']))) { 
    header('Location:index.php');  
    exit(); 

}

   if($_SERVER['REQUEST_METHOD'] === 'POST') {
       if(isset($_POST['email'])  && isset($_POST['haslo1']))  {  
         $email=trim($_POST['email']) ; 
         $haslo1=trim($_POST['haslo1'] );   
        
        $id= Users::verifyPassword($conn, $email, $haslo1) ;  
        
           if($id!=-1) {    
             
              $_SESSION['id']=$id; 
              $_SESSION['zalogowany']=TRUE;
              header('location:glownapo.php');   }  
        
    
               else{  
                 $_SESSION['blad']='<span style="color:red">Nieprawidlowy login 
                    lub hasło !</span>'; 
                header('Location:index.php');
               }
         
       } 
   }
 
$conn->close(); 
$conn=null;
          
         
          

     
 
