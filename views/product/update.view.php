<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'core/database/database.php';
include_once 'core/database/Product.php';
$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

$product->Id_prod = $data->Id_prod;
$product->Name = $data->Name;
$product->Co2 = $data->Co2;



if ($product->update()) {
    http_response_code(200);
    echo json_encode(array("message" => "Updated product"));
} else {
    //503 service unavailable
    http_response_code(503);
    echo json_encode(array("message" => "Unable to update the product"));
}
