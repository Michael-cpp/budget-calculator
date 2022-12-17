<?php

declare(strict_types=1);

spl_autoload_register(function ($class) {
    require __DIR__ . "/src/$class.php";
});

set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handleException");

header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

if (!array_key_exists('entity', $_GET) || empty($_GET['entity']) || $_GET['entity'] != 'purchase') {
    http_response_code(404);
    exit;
}

$id = $_GET['id'] ?? null;

$database = new Database("172.83.24.13", "budget_calculator", "root", "root");

$gateway = new PurchaseGateway($database);

$controller = new PurchaseController($gateway);

$controller->processRequest($_SERVER["REQUEST_METHOD"], $id);













