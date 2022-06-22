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

    public function deleteData($id)
    {
        if(General::checkNumber($id))
            Response::respondAndDie(['Invalid User id ..'],Response::HTTP_NOT_ACCEPTABLE);

        $response = $this->UserModel->deleteUser($id);
        if($response)
            Response::respondAndDie($response,Response::HTTP_OK);
        else
            Response::respondAndDie($response,Response::HTTP_NOT_ACCEPTABLE);

    }

    public function updateData($request_body)
    {
        $id = $request_body['user_id'] ?? null;
        $data = [$request_body['firstName'],$request_body['lastName']];
        if(General::checkNumber($id))
           Response::respondAndDie(['Invalid User id ..'],Response::HTTP_NOT_ACCEPTABLE);
        $result = $this->UserModel->updateUser($id,$data);
        Response::respondAndDie($result,Response::HTTP_OK);
   
    }
    public function NotAllow()
    {
        Response::respondAndDie(['Invalid request Method'],Response::HTTP_METHOD_NOT_ALLOWED);

    }
}