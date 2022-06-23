<?php
namespace MyApp\Utilities;

class General{

    public static function checkNumber($input){
        if(!is_numeric($input) or !is_null($input))
            return false;
        return true;
    }


    public static function IsNullOrEmpty($arr){
        if(count($arr)==0)
            return false;
        foreach($arr as $item)
            if(is_null($item) || empty($item))
                return false;
        return true;
    }

    public static function checkPagin($page,$pagesize)
    {
        $limit = '';    
        if(is_numeric($page) and is_numeric($pagesize)){
            $start = ($page-1) * $pagesize;
            $limit = " LIMIT $start,$pagesize"; // pagination
        }
        return $limit;
    }

    public static function checkOrderBy($orderby)
    {
        $orderByStr = '';
        if(!is_null($orderby))
             $orderByStr = " order by $orderby ";
        return $orderByStr;
    }

    public static function checkWhere($id)
    {
    $where = '';
    if(!is_null($id) and is_numeric($id)){
        $where = "where id = {$id} ";
    }
        return $where;
    }

}