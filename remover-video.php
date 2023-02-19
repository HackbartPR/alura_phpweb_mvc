<?php

use HackbartPR\Utils\Message;
use HackbartPR\Config\ConnectionCreator;
use HackbartPR\Repository\PDOVideoRepository;

session_start();

if (!isset($_GET['id'])) {
    Message::create(Message::NOT_FOUND);
}

$conn = ConnectionCreator::createConnection();
$repository = new PDOVideoRepository($conn);
$result = $repository->remove($_GET['id']);

if ($result) {
    Message::create(Message::REMOVE_SUCCESS);
} else {
    Message::create(Message::REMOVE_FAIL);
}
