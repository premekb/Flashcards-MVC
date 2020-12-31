<?php
/**
 *The model for the users table.
 */
class Users extends Db{
    private $conn;

    function __construct(){
        $this->conn = $this->connect();
    }
    
    /**
     * Returns true if an email is in the DB.
     * 
     * @param email
     * 
     * @return Boolean
     */
    public function emailExists($email){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Inserts a new user into the DB.
     * 
     * @param email
     * @param pwd
     * 
     * @return Void
     */
    public function createUser($email, $pwd){
        try {
            $stmt = $this->conn->prepare("INSERT INTO users (email, pwd) VALUES (:email, :pwd)");
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":pwd", $pwd);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Validates if correct login credentials were entered.
     * 
     * @param pwd
     * @param email
     * 
     * @return Boolean
     */
    public function loginValidation($email, $password){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $result = $stmt->fetch();
            if ($stmt->rowCount() > 0 && password_verify($password, $result["pwd"])){
                return $result["id"];
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Updates user's password.
     * 
     * @param uid
     * @param newPassword
     * 
     * @return void
     */
    public function changePassword($uid, $newPassword){
        try{
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("UPDATE users SET pwd = :newPassword WHERE id = :uid");
            $stmt->bindParam(":newPassword", $newPassword);
            $stmt->bindParam(":uid", $uid);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

    }
}