<?php
namespace MyApp\Model;
class  Model{
    public function __construct() {
      require_once 'connection.php';
      return $pdo;
    }
    public function get()
    {
        
    }

}