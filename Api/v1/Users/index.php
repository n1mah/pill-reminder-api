<?php
require_once realpath("../../../vendor/autoload.php");
use MyApp\v1\Controller\UserController;

$resquest_method = $_SERVER['REQUEST_METHOD'];
$request_body = json_decode(file_get_contents('php://input'),true);

switch ($resquest_method){
    
    case 'GET':
        $user_id = $_GET['user_id'] ?? null;
        $request_data = [
            'user_id' => $user_id,
            'fields' => $_GET['fields'] ?? null,
            'orderby' => $_GET['orderby'] ?? null,
            'page' => $_GET['page'] ?? null,
            'pagesize' => $_GET['pagesize'] ?? null,
        ];
        $UserController = new UserController();
        $Us=$UserController->getData($request_data);
        echo $Us;
            break;

        case 'POST':

            break;

    }