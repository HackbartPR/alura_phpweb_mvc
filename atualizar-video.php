<?php

session_start();

use HackbartPR\Entity\Video;
use HackbartPR\Utils\Message;
use HackbartPR\Config\ConnectionCreator;
use HackbartPR\Repository\PDOVideoRepository;

if (!isset($_POST) || !isset($_GET['id'])) {
    Message::create(Message::FORM_FAIL);
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$title = filter_input(INPUT_POST, 'titulo');

if (!$url) {
    Message::create(Message::URL_FAIL);
}

if (!$title) {
    Message::create(Message::TITLE_FAIL);
}

$conn = ConnectionCreator::createConnection();
$repository = new PDOVideoRepository($conn);
$resp = $repository->save(new Video($id, $title, $url));

if ($resp) {
    Message::create(Message::UPDATE_SUCCESS);
} else {
    Message::create(Message::UPDATE_FAIL);
}