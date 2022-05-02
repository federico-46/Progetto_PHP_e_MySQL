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

$order->Id_order = $data->Id_order;
$order->Date = $data->Date;
$order->Destination = $data->Destination;
$order->Product = $data->Product;
$order->Amount = $data->Amount;

if ($order->update()) {
    http_response_code(200);
    echo json_encode(array("message" => "Order updated"));
} else {
    //503 service unavailable
    http_response_code(503);
    echo json_encode(array("message" => "Unable to update the order"));
}
