<?php
class user {
    private $db;
    function __construct($conn){
        $this->db = $conn;  
    }

    public function insertUser($username,$password) {
        try {
            $result = $this->getUserByUsername($username);
            if($result['num']>0){
                return false;
            }
            else{
            $new_password = md5($password.$username);
            // define sql statement to be executed
            $sql = "INSERT INTO users (username,password) VALUES (:username,:password)";
            //prepare the sql statement for execution
            $stmt = $this->db->prepare($sql);
            //bind the values to the parameters
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $new_password);
            //execute the sql statement
            $stmt->execute();
            
            return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getUser($username,$password) {
        try {
            $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function getUserByUsername($username) {
        try {
            $sql = "SELECT count(*) as num FROM users WHERE username = :username";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}