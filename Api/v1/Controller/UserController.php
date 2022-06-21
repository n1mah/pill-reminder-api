<?php
namespace MyApp\v1\Controller;
use MyApp\Model\UserModel;
use MyApp\Utilities\Response;
use MyApp\Utilities\General;

class UserController{
    public $UserModel ;

    function __construct() {
       $this->UserModel = new UserModel();
    }
    public function getData($data=null)
    {
        $user_id = $data['user_id'] ?? null;
        $orderby = $data['orderby'] ?? null;
        $page = $data['page'] ?? null;
        $pagesize = $data['pagesize'] ?? null;
       
        $orderby =   General::checkOrderBy($orderby);
        $limit =   General::checkPagin($page,$pagesize);
        $where =   General::checkWhere($user_id);
        $queryPlus = "$where $orderby $limit";

        $response = $this->UserModel->getUsers($queryPlus);
        return Response::respond($response,Response::HTTP_OK);
    }
    public function postData($request_body)
    {
        $response = $this->UserModel->addUser($request_body);
        Response::respondAndDie($response,Response::HTTP_CREATED); 
    }
}