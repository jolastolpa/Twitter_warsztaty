<?php

class Comment { 
    private $id;
    private $userId; 
    private $tweetId;
    private $text;
    private $creationDate;  
    

    public function __construct() {

        $this->id = -1;
        $this->userId = ""; 
        $this->tweetId = "";
        $this->text = "";
        $this->creationDate = "";
    }

    public function setText($NewText) {
        $this->text = $NewText;
    }
    public function setUserId($NewUserId) {
        $this->userId = $NewUserId;
    } 
      public function setTweetId($NewTweetId) {
        $this->tweetId = $NewTweetId;
    }
   
    public function setCreationDate($NewCreationDate) {
        $this->creationDate = $NewCreationDate;
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }  
     public function getTweetId() {
        return $this->tweetId;
    } 
     public function getUsername() {
        return $this->username;
    }

    public function getText() {
        return $this->text ;
    } 
     public function getCreationDate() {
        return $this->creationDate ;
    }

    public function saveToDB(mysqli $conn) {
        if ($this->id == -1) {
        //Saving new comment to DB
            $sql = "INSERT INTO Comment(userId,tweetId, text, creationDate) "
                    . "VALUES ('$this->userId', '$this->tweetId','$this->text', "
                    . "'$this->creationDate')";
            $result = $conn->query($sql);
            if ($result == true) {
                $this->id = $conn->insert_id;
                return true;
            }
        }   else { 
            
               $sql = "UPDATE Comment SET userId='$this->userId',
               text='$this->text',
               creationDate='$this->creationDate'
               WHERE id=$this->id";
               $result = $conn->query($sql);
               if($result == true){
               return true;
               }
            }
                return false;
    }
        
       
    
  static public function loadCommentById(mysqli $conn, $id){
    $sql = "SELECT * FROM Comment WHERE id=$id";
    $result = $conn->query($sql); 
    
    if($result == true && $result->num_rows == 1){
        $row = $result->fetch_assoc();
        $loadedComment = new Comment();
        $loadedComment->id = $row['id'];
        $loadedComment->userId = $row['userId']; 
        $loadedComment->tweetId=$row['tweetId'];
        $loadedComment->text = $row['text'];
        $loadedComment->creationDate = $row['creationDate'];
        return $loadedComment;
    }
    return null; 
  }
  
 
  
   static public function loadAllCommentByTweetId(mysqli $conn, $tweetId){
    $sql = "SELECT Comment.*, Users.username FROM Comment JOIN Users ON 
            Comment.userId=Users.id WHERE tweetId=$tweetId ORDER BY creationDate DESC";
    $ret = [];
    $result = $conn->query($sql);
    if($result == true && $result->num_rows != 0){
      foreach($result as $row){
        $loadedComment = new Comment();
        $loadedComment->id = $row['id'];
        $loadedComment->userId = $row['userId']; 
        $loadedComment->tweetId=$row['tweetId'];
        $loadedComment->text = $row['text'];
        $loadedComment->creationDate = $row['creationDate']; 
        $loadedComment->username=$row['username'];
        $ret[] = $loadedComment;
        }
        }
    return $ret;
  } 
 
   public function delete(mysqli $conn){
    if($this->id != -1){
    $sql = "DELETE FROM Comment WHERE id=$this->id";
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



