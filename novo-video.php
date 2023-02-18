<?php

use HackbartPR\Entity\Video;
use HackbartPR\Utils\Message;
use HackbartPR\Config\ConnectionCreator;
use HackbartPR\Repository\PDOVideoRepository;

session_start();

if (!isset($_POST)) {
    Message::create(Message::FORM_FAIL);
}

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
$resp = $repository->save(new Video(null, $title, $url));

if ($resp) {
    Message::create(Message::REGISTER_SUCCESS);
} else {
    Message::create(Message::REGISTER_FAIL);
}