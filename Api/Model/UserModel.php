<?php
namespace MyApp\Model;
use PDO,PDOException;
class UserModel extends Model{
    public $pdo;
    const TBL = "users";
    public $select = "SELECT * FROM ".UserModel::TBL;
    function __construct() {
       $this->pdo=parent::__construct();
    }
    
    //Get All Users
    function getUsers($queryPlus){
        $select= $this->select . " $queryPlus";
        return $this->pdo->query($select)->fetchAll();
    }

    //Get one User with ID
    function getUser($id){
        $queryString="$this->select WHERE id = $id";
        return $this->pdo->query($queryString)->fetch();
    }

    //Add User by Data (two parameter)
    function addUser($data=[]){
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $firstName = $data["firstName"] ?? null;
        $lastName = $data["lastName"] ?? null;
        $queryString = "INSERT INTO `users` (`firstName`, `lastName`) 
                        VALUES ('$firstName', '$lastName');";
        try {
            $this->pdo->exec($queryString);
        return $this->pdo->lastInsertId();
        } catch(PDOException $e) {
        return $e->getMessage();
      }
    }

    //Update User by Data (two parameter)
    function updateUser($id,$data=[]){
         [$firstName,$lastName] = $data;
         $update="UPDATE " . UserModel::TBL . " SET";
         $queryString = "$update firstName='$firstName' , lastName='$lastName' WHERE id=$id";
         try{
         $exec = $this->pdo->prepare($queryString);
         $exec->execute();
          return $exec->rowCount();
         } catch(PDOException $e) {
            return $e->getMessage();
         }
    }

    //Delete one User with ID
    function deleteUser($id){
        $queryString="DELETE FROM " . UserModel::TBL . " WHERE id=$id";
        try {
            $exec=$this->pdo->prepare($queryString); 
            $exec->execute();
            $row_delete=$exec->rowCount();
            return $row_delete;
          } catch(PDOException $e) {
            return $e->getMessage();
          }
       
    }
    
}