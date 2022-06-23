<?php
namespace MyApp\v1\Controller;
use MyApp\Model\TypeModel;
use MyApp\Utilities\Response;
use MyApp\Utilities\General;

class TypeController{
    public $TypeModel ;

    function __construct() {
       $this->TypeModel = new TypeModel();
    }
    public function getData($data=null)
    {
        $type_id = $data['type_id'] ?? null;
        $orderby = $data['orderby'] ?? null;
        $page = $data['page'] ?? null;
        $pagesize = $data['pagesize'] ?? null;
       
        $orderby =   General::checkOrderBy($orderby);
        $limit =   General::checkPagin($page,$pagesize);
        $where =   General::checkWhere($type_id);
        $queryPlus = "$where $orderby $limit";

        $response = $this->TypeModel->getTypes($queryPlus);
        if(!General::IsNullOrEmpty($response))
             Response::respondAndDie("{Message : Not Found Type By Id $type_id}",Response::HTTP_NOT_FOUND);
        Response::respondAndDie($response,Response::HTTP_OK);
    }
    public function postData($request_body)
    {
        $typeID = $this->TypeModel->addType($request_body);
        Response::respondAndDie("{Message : Type Added by Id $typeID}",Response::HTTP_CREATED); 
    }

    public function deleteData($id)
    {
        if(General::checkNumber($id))
            Response::respondAndDie(['Invalid Type id ..'],Response::HTTP_NOT_ACCEPTABLE);

        $row_result = $this->TypeModel->deleteType($id);
        if($row_result)
            Response::respondAndDie("{Message : Type By Id $id Deleted}",Response::HTTP_OK);
        else
            Response::respondAndDie("{Message : not delete}",Response::HTTP_NOT_ACCEPTABLE);

    }

    public function updateData($request_body)
    {
        $id = $request_body['type_id'] ?? null;
        $data = [$request_body['title'] ?? null];
        var_dump($id);
        var_dump($data[0]);
        if(!General::IsNullOrEmpty([$id,$data[0]]))
           Response::respondAndDie(['Ivalnid Data Sent ..'],Response::HTTP_NOT_ACCEPTABLE);
        if(General::checkNumber($id))
           Response::respondAndDie(['Invalid Type id ..'],Response::HTTP_NOT_ACCEPTABLE);
        $row_result = $this->TypeModel->updateType($id,$data);
        if($row_result)
            Response::respondAndDie("{Message : Type By Id $id Updated}",Response::HTTP_OK);
         else
            Response::respondAndDie("{Message : not Change}",Response::HTTP_NOT_ACCEPTABLE);

    }
    public function NotAllow()
    {
        Response::respondAndDie(['Invalid request Method'],Response::HTTP_METHOD_NOT_ALLOWED);

    }
}