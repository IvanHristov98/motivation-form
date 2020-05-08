<?php 

session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__ . '/vendor/autoload.php';
use form\db\DBConnection;
use form\handler\UserHandler;
use form\zodiac\Zodiac;

try {
    $user = new UserHandler();
    $user->uploadClient();
} catch(Exception $e) {
    http_response_code(400);
    echo json_encode($e->getMessage());
}
