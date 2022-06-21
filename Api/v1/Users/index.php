<?php
require_once realpath("../../../vendor/autoload.php");
use MyApp\v1\Controller\UserController;

$resquest_method = $_SERVER['REQUEST_METHOD'];
$request_body = json_decode(file_get_contents('php://input'),true);
$UserController = new UserController();
echo $resquest_method;
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
            $result=$UserController->getData($request_data);
            echo $result;
            break;

        case 'POST':
            var_dump($request_body); //Raw Send Body  //Defult Value is Null
            var_dump($_REQUEST); //X-WWW-Form & From Data //Defult Value is array(0)
            // $data=$UserController->postData($request_body);

            break;

    }