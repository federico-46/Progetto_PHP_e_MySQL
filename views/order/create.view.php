<?php

//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'core/database/database.php';
include_once 'core/database/Order.php';

$database = new Database();
$db = $database->getConnection();

$order = new Order($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->Date) &&
    !empty($data->Destination) &&
    !empty($data->Product) &&
    !empty($data->Amount)
) {
    $order->Date = $data->Date;
    $order->Destination = $data->Destination;
    $order->Product = $data->Product;
    $order->Amount = $data->Amount;



    if ($order->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Order created successfully."));
    } else {
        //503 Service Unavailable
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create order."));
    }
} else {
    //400 bad request
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create order, data is incomplete."));
}
