<?php
namespace MyApp\v1\Controller;
use MyApp\Model\UserModel;
use MyApp\Utilities\Response;
use MyApp\Utilities\Validation;

class UserController{
    public $UserModel ;

    function __construct() {
       $this->UserModel = new UserModel();
    }
    public function getData($data=null)
    {
        $user_id = $data['user_id'] ?? null;
        $fields = $data['fields'] ?? '*';
        $orderby = $data['orderby'] ?? null;
        $page = $data['page'] ?? null;
        $pagesize = $data['pagesize'] ?? null;
       
        $orderby =   Validation::checkOrderBy($orderby);
        $limit = Validation::checkPagin($page,$pagesize);
        $where =   Validation::checkWhere($user_id);
        $queryPlus = "$where $orderby $limit";

        $response = $this->UserModel->getUsers($queryPlus);
        return Response::respond($response,Response::HTTP_OK);
    }

}