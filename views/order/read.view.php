<?php
include_once 'core/database/database.php';
include_once 'core/database/Order.php';

$database = new Database();
$db = $database->getConnection();

$order = new Order($db);
$stmt = $order->read();

$num = $stmt->rowCount();
if ($num > 0) {
    $orders_arr = array();
    $orders_arr["list"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $order_item = array("Date" => $Date, "Destination" => $Destination, "Product" => $Product, "Amount" => $Amount, "Id_order" => $Id_order, "Co2_Saved" => $Co2_Saved);
        array_push($orders_arr["list"], $order_item);
    }
    http_response_code(200);
    echo json_encode($orders_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "No orders found."));
}
