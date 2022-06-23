<?php
require_once realpath("../../../vendor/autoload.php");
use MyApp\v1\Controller\TypeController;

$resquest_method = $_SERVER['REQUEST_METHOD'];
$request_body = json_decode(file_get_contents('php://input'),true);
$TypeController = new TypeController();
switch ($resquest_method){
        case 'GET':
            $request_data = [
                'type_id' => $_GET['type_id'] ?? null,
                'fields' => $_GET['fields'] ?? null,
                'orderby' => $_GET['orderby'] ?? null,
                'page' => $_GET['page'] ?? null,
                'pagesize' => $_GET['pagesize'] ?? null,
            ];
            $result=$TypeController->getData($request_data);
            break;

        case 'POST':
            $data=$TypeController->postData($request_body);
            break;

        case 'PUT':
          $data=$TypeController->updateData($request_body);
          break;

        case 'DELETE':
            $type_id = (int)$_GET['type_id'] ?? null;
            $data=$TypeController->deleteData($type_id);
            break;

        default:
            $data=$TypeController->NotAllow();

    }