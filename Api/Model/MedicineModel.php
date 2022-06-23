<?php
namespace MyApp\Model;
use PDO,PDOException;
class MedicineModel extends Model{
    public $pdo;
    const TBL = "medicines";
    public $select = "SELECT * FROM ". self::TBL;
    function __construct() {
       $this->pdo=parent::__construct();
    }
    
    function getMedicines($queryPlus){
        $select= $this->select . " $queryPlus";
        return $this->pdo->query($select)->fetchAll();
    }

    function getMedicine($id){
        $queryString="$this->select WHERE id = $id";
        return $this->pdo->query($queryString)->fetch();
    }

    function addMedicine($data=[]){
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $title = $data["title"] ?? null;
        $id_type = $data["id_type"] ?? null;
        $id_user_added = $data["id_user_added"] ?? 1;
        $nameFa = $data["nameFa"] ?? null;
        $nameEn = $data["nameEn"] ?? null;
        $drugInteractions = $data["drugInteractions"] ?? null;
        $descriptionDosage = $data["descriptionDosage"] ?? null;
        $dose = $data["dose"] ?? null;

        $queryString = "INSERT INTO `".self::TBL."` (`id_type` , `id_user_added` , `title` ,
                       `nameFa` , `nameEn` , `drugInteractions` , `descriptionDosage` , `dose`) 
                        VALUES ('$id_type' , '$id_user_added' , '$title' , '$nameFa' , '$nameEn' , 
                        '$drugInteractions' , '$descriptionDosage'  , '$dose' );";
        try {
            $this->pdo->exec($queryString);
        return $this->pdo->lastInsertId();
        } catch(PDOException $e) {
        return $e->getMessage();
      }
    }

    function updateMedicine($id,$data=[]){
         [$id_type,$id_user_added,$title,$nameFa,$nameEn,$drugInteractions,$descriptionDosage,$dose] = $data;
         $update="UPDATE " . self::TBL . " SET";
         $queryString = "$update id_type='$id_type' , id_user_added='$id_user_added' , title='$title' , nameFa='$nameFa' 
         , nameEn='$nameEn' , drugInteractions='$drugInteractions' , descriptionDosage='$descriptionDosage'
         , dose='$dose' WHERE id=$id";
         try{
         $exec = $this->pdo->prepare($queryString);
         $exec->execute();
          return $exec->rowCount();
         } catch(PDOException $e) {
            return $e->getMessage();
         }
    }

    function deleteMedicine($id){
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