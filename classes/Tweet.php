<?php

class Tweet { 
    private $id;
    private $userId;
    private $text;
    private $creationDate;  
    private $username;

    public function __construct() {

        $this->id = -1;
        $this->userId = "";
        $this->text = "";
        $this->creationDate = "";
    }

    public function setText($NewText) {
        $this->text = $NewText;
    }
    public function setUserId($NewUserId) {
        $this->userId = $NewUserId;
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
        //Saving new user to DB
            $sql = "INSERT INTO Tweet(userId, text, creationDate) "
                    . "VALUES ('$this->userId', '$this->text', "
                    . "'$this->creationDate')";
            $result = $conn->query($sql);
            if ($result == true) {
                $this->id = $conn->insert_id;
                return true;
            }
        }   else { 
            
               $sql = "UPDATE Tweet SET userId='$this->userId',
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
        
       
    
  static public function loadTweetById(mysqli $conn, $id){
    $sql = "SELECT Tweet.* ,Users.username FROM Tweet, "
            . "Users WHERE Tweet.id=$id AND Tweet.userId=Users.id ";
    $result = $conn->query($sql); 
    
    if($result == true && $result->num_rows == 1){
        $row = $result->fetch_assoc();
        $loadedTweet = new Tweet();
        $loadedTweet->id = $row['id'];
        $loadedTweet->userId = $row['userId']; 
        $loadedTweet->username = $row['username'];
        $loadedTweet->text = $row['text'];
        $loadedTweet->creationDate = $row['creationDate'];
        return $loadedTweet;
    }
    return null; 
  }
  
   static public function loadTweetByUserId(mysqli $conn, $userId){
    $sql = "SELECT * FROM Tweet WHERE userId=$userId";
    $result = $conn->query($sql); 
    
    if($result == true && $result->num_rows == 1){
        $row = $result->fetch_assoc();
        $loadedTweet = new Tweet();
        $loadedTweet->id = $row['id'];
        $loadedTweet->userId = $row['userId'];
        $loadedTweet->text = $row['text'];
        $loadedTweet->creationDate = $row['creationDate'];
        return $loadedTweet;
    }
  return null; 
  }
  
   static public function loadAllTweets(mysqli $conn){
    $sql = "SELECT Tweet.* ,Users.username FROM Tweet, Users WHERE Tweet.userId=Users.id "
            . "ORDER BY creationDate DESC";
    $ret = [];
    $result = $conn->query($sql);
    if($result == true && $result->num_rows != 0){
      foreach($result as $row){
        $loadedTweet = new Tweet();
        $loadedTweet->id = $row['id'];
        $loadedTweet->userId = $row['userId'];
        $loadedTweet->text = $row['text'];
        $loadedTweet->creationDate = $row['creationDate']; 
        $loadedTweet->username=$row['username'];
        $ret[] = $loadedTweet;
        }
        }
    return $ret;
  } 
      static public function loadTweetsByUserId($conn, $userId){
    $sql = "SELECT * FROM Tweet WHERE userId=$userId ORDER BY creationDate DESC";
    $ret = [];
    $result = $conn->query($sql);
    if($result == true && $result->num_rows != 0){
      foreach($result as $row){
        $loadedTweet = new Tweet();
        $loadedTweet->id = $row['id'];
        $loadedTweet->userId = $row['userId'];
        $loadedTweet->text = $row['text'];
        $loadedTweet->creationDate = $row['creationDate']; 
        //$loadedTweet->username=$row['username'];
        $ret[] = $loadedTweet;
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

