<?php
require_once realpath("../../../vendor/autoload.php");
use MyApp\v1\Controller\MedicineController;

$resquest_method = $_SERVER['REQUEST_METHOD'];
$request_body = json_decode(file_get_contents('php://input'),true);
$MedicineController = new MedicineController();
switch ($resquest_method){
        case 'GET':
            $request_data = [
                'medicine_id' => $_GET['medicine_id'] ?? null,
                'fields' => $_GET['fields'] ?? null,
                'orderby' => $_GET['orderby'] ?? null,
                'page' => $_GET['page'] ?? null,
                'pagesize' => $_GET['pagesize'] ?? null,
            ];
            $result=$MedicineController->getData($request_data);
            break;

        case 'POST':
            $data=$MedicineController->postData($request_body);
            break;

        case 'PUT':
          $data=$MedicineController->updateData($request_body);
          break;

        case 'DELETE':
            $medicine_id = (int)$_GET['medicine_id'] ?? null;
            $data=$MedicineController->deleteData($medicine_id);
            break;

        default:
            $data=$MedicineController->NotAllow();

    }