<?php
namespace MyApp\Utilities;

class General{

    public static function checkNumber($input){
        if(!is_numeric($input) or !is_null($input))
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

    public static function checkWhere($user_id)
    {
    $where = '';
    if(!is_null($user_id) and is_numeric($user_id)){
        $where = "where id = {$user_id} ";
    }
        return $where;
    }
}