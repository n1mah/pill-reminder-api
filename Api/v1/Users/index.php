<?php
require_once realpath("../../../vendor/autoload.php");
use MyApp\v1\Controller\UserController;

$resquest_method = $_SERVER['REQUEST_METHOD'];
$request_body = json_decode(file_get_contents('php://input'),true);
$UserController = new UserController();
switch ($resquest_method){
        case 'GET':
            $request_data = [
                'user_id' => $_GET['user_id'] ?? null,
                'fields' => $_GET['fields'] ?? null,
                'orderby' => $_GET['orderby'] ?? null,
                'page' => $_GET['page'] ?? null,
                'pagesize' => $_GET['pagesize'] ?? null,
            ];
            $result=$UserController->getData($request_data);
            break;

        case 'POST':
            $data=$UserController->postData($request_body);
            break;

        case 'PUT':
          $data=$UserController->updateData($request_body);
          break;

        case 'DELETE':
            $user_id = (int)$_GET['user_id'] ?? null;
            $data=$UserController->deleteData($user_id);
            break;

        default:
            $data=$UserController->NotAllow();

    }