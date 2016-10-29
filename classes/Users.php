<?php



class Users {

    private $id;
    private $username;
    private $hashedPassword;
    private $email;

    public function __construct() {

        $this->id = -1;
        $this->username = "";
        $this->email = "";
        $this->hashedPassword = "";
    }

    public function setUsername($NewUsername) {
        $this->username = $NewUsername;
    }

    public function setPassword($newPassword) {
        $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPassword;
    }

    public function setEmail($NewEmail) {
        $this->email = $NewEmail;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getHashedPassword() {
        return $this->hashedPassword;
    }

    public function getEmail() {
        return $this->email;
    }

    public function saveToDB(mysqli $conn) {
        if ($this->id == -1) {
        //Saving new user to DB
            $sql = "INSERT INTO Users(username, email, hashed_password) "
                    . "VALUES ('$this->username', '$this->email', "
                    . "'$this->hashedPassword')";
            $result = $conn->query($sql);
            if ($result == true) {
                $this->id = $conn->insert_id;
                return true;
            }
        }   else { 
            
               $sql = "UPDATE Users SET username='$this->username',
              
               hashed_password='$this->hashedPassword'
               WHERE id=$this->id";
               $result = $conn->query($sql);
               if($result == true){
               return true;
               }
            }
                return false;
    }
        
       
    
  static public function loadUserById(mysqli $conn, $id){
    $sql = "SELECT * FROM Users WHERE id=$id";
    $result = $conn->query($sql); 
    
    if($result == true && $result->num_rows == 1){
        $row = $result->fetch_assoc();
        $loadedUser = new Users();
        $loadedUser->id = $row['id'];
        $loadedUser->username = $row['username'];
        $loadedUser->hashedPassword = $row['hashed_password'];
        $loadedUser->email = $row['email'];
        return $loadedUser;
    }
  return null; 
  }

  static public function loadAllUsers(mysqli $connection){
    $sql = "SELECT * FROM Users";
    $ret = [];
    $result = $connection->query($sql);
    if($result == true && $result->num_rows != 0){
      foreach($result as $row){
        $loadedUser = new User();
        $loadedUser->id = $row['id'];
        $loadedUser->username = $row['username'];
        $loadedUser->hashedPassword = $row['hashed_password'];
        $loadedUser->email = $row['email'];
        $ret[] = $loadedUser;
        }
        }
    return $ret;
  } 
 
  static public function verifyPassword(mysqli $conn,$email,$haslo1) {
    
     $sql = "SELECT*FROM Users WHERE email= '$email' ";
        $result = $conn->query($sql); 

        if($result->num_rows == 1) {  
           $row = $result->fetch_assoc(); 
           $hashed_password=$row['hashed_password']; 
           
           
            if(password_verify($haslo1,$hashed_password)) {  
             
               $id=$row['id'];  
               return $id ;
            }
        
        }  
        return -1;
  }
  
  
  public function delete(mysqli $conn){
    if($this->id != -1){
    $sql = "DELETE FROM Users WHERE id=$this->id";
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