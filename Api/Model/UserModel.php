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
    
    
    function getUsers(){
        return [$this->pdo->query($this->select)->fetchAll(),$this->select];
    }
    function getUser($id){
        $queryString="$this->select WHERE id = $id";
        return [$this->pdo->query($queryString)->fetch(),$queryString];
    }

    function addUser($data=[]){
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        [$firstName,$lastName] = $data;
        $queryString = "INSERT INTO `users` (`firstName`, `lastName`) 
                        VALUES ('$firstName', '$lastName');";
        try {
            $this->pdo->exec($queryString);
        echo "New record created successfully";
        } catch(PDOException $e) {
        echo $queryString . "<br>" . $e->getMessage();
      }
    }

    function updateUser($id,$data=[]){
         [$firstName,$lastName] = $data;
         $update="UPDATE " . UserModel::TBL . " SET";
         $queryString = "$update firstName='$firstName' , lastName='$lastName' WHERE id=$id";
         $exec = $this->pdo->prepare($queryString);
         $exec->execute();
         echo $exec->rowCount() . " records UPDATED successfully";
    }

    function deleteUser($id){
        $queryString="DELETE FROM " . UserModel::TBL . " WHERE id=$id";
        try {
            $this->pdo->exec($queryString);
            echo "Record deleted successfully";
          } catch(PDOException $e) {
            echo $queryString . "<br>" . $e->getMessage();
          }
       
    }
    
}