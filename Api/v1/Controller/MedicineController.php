<?php
namespace MyApp\v1\Controller;
use MyApp\Model\MedicineModel;
use MyApp\Utilities\Response;
use MyApp\Utilities\General;

class MedicineController{
    public $MedicineModel ;

    function __construct() {
       $this->MedicineModel = new MedicineModel();
    }
    public function getData($data=null)
    {
        $medicine_id = $data['medicine_id'] ?? null;
        $orderby = $data['orderby'] ?? null;
        $page = $data['page'] ?? null;
        $pagesize = $data['pagesize'] ?? null;
       
        $orderby =   General::checkOrderBy($orderby);
        $limit =   General::checkPagin($page,$pagesize);
        $where =   General::checkWhere($medicine_id);
        $queryPlus = "$where $orderby $limit";

        $response = $this->MedicineModel->getMedicines($queryPlus);
        if(!General::IsNullOrEmpty($response))
             Response::respondAndDie("{Message : Not Found Medicine By Id $medicine_id}",Response::HTTP_NOT_FOUND);
        Response::respondAndDie($response,Response::HTTP_OK);
    }
    public function postData($request_body)
    {
        $MedicineID = $this->MedicineModel->addMedicine($request_body);
        Response::respondAndDie("{Message : Medicine Added by Id $MedicineID}",Response::HTTP_CREATED); 
    }

    public function deleteData($id)
    {
        if(General::checkNumber($id))
            Response::respondAndDie(['Invalid Medicine id ..'],Response::HTTP_NOT_ACCEPTABLE);

        $row_result = $this->MedicineModel->deleteMedicine($id);
        if($row_result)
            Response::respondAndDie("{Message : Medicine By Id $id Deleted}",Response::HTTP_OK);
        else
            Response::respondAndDie("{Message : not delete}",Response::HTTP_NOT_ACCEPTABLE);

    }

    public function updateData($request_body)
    {
        $id = $request_body['medicine_id'] ?? null;
        $data = [$request_body['id_type'] ?? null,$request_body['id_user_added'] ?? null,$request_body['title'] ?? null
                ,$request_body['nameFa'] ?? null,$request_body['nameEn'] ?? null,$request_body['drugInteractions'] ?? null
                ,$request_body['descriptionDosage'] ?? null,$request_body['dose'] ?? null];
        if(!General::IsNullOrEmpty([$id,$data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7]]))
           Response::respondAndDie(['Ivalnid Data Sent ..'],Response::HTTP_NOT_ACCEPTABLE);
        if(General::checkNumber($id))
           Response::respondAndDie(['Invalid Medicine id ..'],Response::HTTP_NOT_ACCEPTABLE);
        $row_result = $this->MedicineModel->updateMedicine($id,$data);
        if($row_result)
            Response::respondAndDie("{Message : Medicine By Id $id Updated}",Response::HTTP_OK);
         else
            Response::respondAndDie("{Message : not Change}",Response::HTTP_NOT_ACCEPTABLE);

    }
    public function NotAllow()
    {
        Response::respondAndDie(['Invalid request Method'],Response::HTTP_METHOD_NOT_ALLOWED);

    }
}