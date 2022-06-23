<?php
namespace MyApp\Model;
use PDO,PDOException;
class TypeModel extends Model{
    public $pdo;
    const TBL = "types";
    public $select = "SELECT * FROM ". self::TBL;
    function __construct() {
       $this->pdo=parent::__construct();
    }
    
    function getTypes($queryPlus){
        $select= $this->select . " $queryPlus";
        return $this->pdo->query($select)->fetchAll();
    }

    function getType($id){
        $queryString="$this->select WHERE id = $id";
        return $this->pdo->query($queryString)->fetch();
    }

    function addType($data=[]){
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $title = $data["title"] ?? null;
        $queryString = "INSERT INTO `".self::TBL."` (`title`) 
                        VALUES ('$title');";
        try {
            $this->pdo->exec($queryString);
        return $this->pdo->lastInsertId();
        } catch(PDOException $e) {
        return $e->getMessage();
      }
    }

    function updateType($id,$data=[]){
         [$title] = $data;
         $update="UPDATE " . self::TBL . " SET";
         $queryString = "$update title='$title' WHERE id=$id";
         try{
         $exec = $this->pdo->prepare($queryString);
         $exec->execute();
          return $exec->rowCount();
         } catch(PDOException $e) {
            return $e->getMessage();
         }
    }

    function deleteType($id){
        $queryString="DELETE FROM " . self::TBL . " WHERE id=$id";
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