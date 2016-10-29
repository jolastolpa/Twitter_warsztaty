<?php

 class Message{
    private $id;
    private $senderUserId;
    private $recipientUserId; 
    private $senderUserName;
    private $recipientUserName;
    private $text;
    private $ifRead;
    private $creationDate;
 
    
    public function __construct() {

        $this->id = -1;
        $this->senderUserId = ""; 
        $this->recipientUserId = "";
        $this->text = "";
        $this->creationDate = ""; 
        $this->ifRead=0;
    }

    public function setText($NewText) {
        $this->text = $NewText;
    }
    public function setSenderUserId($NewSenderUserId) {
        $this->senderUserId = $NewSenderUserId;
    } 
    public function setRecipientUserId($NewRecipientUserId) {
        $this->recipientUserId = $NewRecipientUserId;
    }
    
   
    public function setCreationDate($NewCreationDate) {
        $this->creationDate = $NewCreationDate;
    } 
    public function setIfRead($NewIfRead) { 
        $this->ifRead=$NewIfRead;

    
    }

    public function getId() {
        return $this->id;
    }

    public function getSenderUserId() {
        return $this->senderUserId;
    }  
     public function getRecipientUserId() {
        return $this->recipientUserId;
    } 
    
     public function getSenderUsername() {
        return $this->senderUsername;
    }
    public function getRecipientUsername() {
        return $this->recipientUsername;
    }
    public function getText() {
        return $this->text ;
    } 
     public function getCreationDate() {
        return $this->creationDate ;
    } 
     public function getIfRead() {
        return $this->ifRead ;
    } 

    public function saveToDB(mysqli $conn) {
        if ($this->id == -1) {
        //Saving new user to DB
        $sql = "INSERT INTO Message(senderUserId,recipientUserId ,text,"
                . " creationDate,ifRead) "
                . "VALUES ('$this->senderUserId','$this->recipientUserId' '$this->text', "
                . "'$this->creationDate'$this->ifRead')";
            $result = $conn->query($sql);
            if ($result == true) {
                $this->id = $conn->insert_id;
                return true;
            } 
        }   
           else{ 
             $sql="UPDATE Messages SET ifRead=1 WHERE $id=$this->id" ; 
             $result=$conn->query($sql); 
             if($result==TRUE) {
                 RETURN TRUE;
             }
           }
           RETURN FALSE;
    }
        
       
    
  static public function loadMessageById(mysqli $conn, $id){
    $sql = "SELECT Message.*, JOIN Users ON Users.id=Message.recipientUserId "
            . "AND Users.id=Message.senderUserId WHERE Message.id=$id";
    $result = $conn->query($sql); 
    
    if($result == true && $result->num_rows == 1){
        $row = $result->fetch_assoc();
        $loadedMessage = new Message();
        $loadedMessage->id = $row['id'];
        $loadedMessage->ifRead = $row['ifRead']; 
        $loadedMessage->recipientUserId = $row['recipientUserId']; 
        $loadedMessage->recipientUserName = $row['recipientUserName']; 
        $loadedMessage->senderUserId = $row['sendertUserId'];
        $loadedMessage->senderUserName = $row['sendertUserName'];
        $loadedMessage->text = $row['text'];
        $loadedMessaget->creationDate = $row['creationDate'];
        return $loadedTweet;
    }
    return null; 
  }
  
   static public function loadMessagesBySenderUserId(mysqli $conn, $senderUserId){
        
       $sql = "SELECT Message id,recipientUserId,ifRead,text,creationDate FROM Message"
            . "JOIN Users ON Users.id=Message.recipientUserId "
            . "WHERE senderUserId=$senderUserId ORDER BY creationDate DESC";
        
        $result = $conn->query($sql);  
        $ret=[];
    
        if($result == true && $result->num_rows != 0){ 
          foreach($result as $row){
              $row = $result->fetch_assoc();
              $loadedMessage = new Message();
              $loadedMessage->id = $row['id'];
              $loadedMessage->ifRead = $row['ifRead']; 
              $loadedMessage->recipientUserId = $row['recipientUserId']; 
              $loadedMessage->recipientUserName = $row['recipientUserName'];
              $loadedMessage->text = $row['text'];
              $loadedMessaget->creationDate = $row['creationDate'];
              $ret[]= $loadedMessage; 
          }
        }
        return $ret; 
   }
     
   
    static public function loadMessagesByRecipientUserId(mysqli $conn, $recipientUserId){
        
        $sql = "SELECT Message id,senderUserId,ifRead,text,creationDate FROM Message"
            . "JOIN Users ON Users.id=Message.senderUserId "
            . "WHERE recipientUserId=$recipientUserId ORDER BY creationDate DESC";
        
        $result = $conn->query($sql); 
        $ret=[];
        
        if($result == true && $result->num_rows != 0){ 
          foreach($result as $row){
            $row = $result->fetch_assoc();
            $loadedMessage = new Message();
            $loadedMessage->id = $row['id'];
            $loadedMessage->ifRead = $row['ifRead']; 
            $loadedMessage->senderUserId = $row['sendertUserId'];
            $loadedMessage->senderUserName = $row['sendertUserName'];
            $loadedMessage->text = $row['text'];
            $loadedMessage->creationDate = $row['creationDate'];
            $ret[]= $loadedMessage;
          } 
        }
        return $ret;  
    }
  
  
  
 public function delete(mysqli $conn){
    if($this->id != -1){
    $sql = "DELETE FROM Tweet WHERE id=$this->id";
    $result = $conn->query($sql);
      if($result == true){
      $this->id = -1;
        return true;
      }
      return false;
    } 
    return true; 
  } 
}


    
    
    
    
    
  
 
 
 

