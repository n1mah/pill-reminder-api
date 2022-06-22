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
        if(!General::IsNullOrEmpty($response))
             Response::respondAndDie("{Message : Not Found User By Id $user_id}",Response::HTTP_NOT_FOUND);
       Response::respondAndDie($response,Response::HTTP_OK);
    }
    public function postData($request_body)
    {
        $UserID = $this->UserModel->addUser($request_body);
        Response::respondAndDie("{Message : User Added by Id $UserID}",Response::HTTP_CREATED); 
    }

    public function deleteData($id)
    {
        if(General::checkNumber($id))
            Response::respondAndDie(['Invalid User id ..'],Response::HTTP_NOT_ACCEPTABLE);

        $row_result = $this->UserModel->deleteUser($id);
        if($row_result)
            Response::respondAndDie("{Message : User By Id $id Deleted}",Response::HTTP_OK);
        else
            Response::respondAndDie("{Message : not delete}",Response::HTTP_NOT_ACCEPTABLE);

    }

    public function updateData($request_body)
    {
        $id = $request_body['user_id'] ?? null;
        $data = [$request_body['firstName'] ?? null,$request_body['lastName'] ?? null];
        if(!General::IsNullOrEmpty([$id,$data[0],$data[1]]))
           Response::respondAndDie(['Ivalnid Data Sent ..'],Response::HTTP_NOT_ACCEPTABLE);
        if(General::checkNumber($id))
           Response::respondAndDie(['Invalid User id ..'],Response::HTTP_NOT_ACCEPTABLE);
        $row_result = $this->UserModel->updateUser($id,$data);
        if($row_result)
            Response::respondAndDie("{Message : User By Id $id Updated}",Response::HTTP_OK);
         else
            Response::respondAndDie("{Message : not Change}",Response::HTTP_NOT_ACCEPTABLE);

    }
    public function NotAllow()
    {
        Response::respondAndDie(['Invalid request Method'],Response::HTTP_METHOD_NOT_ALLOWED);

    }
}