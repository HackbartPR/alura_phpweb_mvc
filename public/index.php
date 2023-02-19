<?php

require_once __DIR__ . '/../vendor/autoload.php';

use HackbartPR\Utils\Message;
use HackbartPR\Config\ConnectionCreator;
use HackbartPR\Repository\PDOVideoRepository;
use HackbartPR\Controller\NewVideoController;
use HackbartPR\Controller\SendVideoController;
use HackbartPR\Controller\ShowVideoController;
use HackbartPR\Controller\RemoveVideoController;
use HackbartPR\Controller\UpdateVideoController;

session_start();

$conn = ConnectionCreator::createConnection();
$repository = new PDOVideoRepository($conn);
$message = new Message();

$path = $_SERVER['PATH_INFO'];
$method = $_SERVER['REQUEST_METHOD'];

if ($path === '/' || !array_key_exists('PATH_INFO', $_SERVER)) {
    $controller = new ShowVideoController($repository, $message);
        $controller->processRequest();
} else if ($path === '/novo') {
    if ($method === 'GET') {
        $controller = new SendVideoController($repository, $message);
        $controller->processRequest();
    } else if ($method === 'POST') {
        $controller = new NewVideoController($repository, $message);
        $controller->processRequest();
    }
} else if ($path === '/editar') {
    if ($method === 'GET') {
        $controller = new SendVideoController($repository, $message);
        $controller->processRequest();
    } else if ($method === 'POST') {
        $controller = new UpdateVideoController($repository, $message);
        $controller->processRequest();
    }
} else if ($path === '/remover') {
    $controller = new RemoveVideoController($repository, $message);
    $controller->processRequest();
} else {
    http_response_code(404);
}