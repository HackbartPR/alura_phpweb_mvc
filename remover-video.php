<?php

use HackbartPR\Config\ConnectionCreator;
use HackbartPR\Repository\PDOVideoRepository;

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_GET['id'])) {
    $_SESSION['save']['status'] = false;
    $_SESSION['save']['message'] = "Livro não informado!";
    header('Location: /');    
}

$conn = ConnectionCreator::createConnection();
$repository = new PDOVideoRepository($conn);
$result = $repository->remove($_GET['id']);

$_SESSION['save']['status'] = $result;
if ($result) {
    $_SESSION['save']['message'] = "Livro excluído com sucesso!";
    header('Location: /');
} else {
    $_SESSION['save']['message'] = "Livro não pode ser excluído, tente novamente!";
    header('Location: /');
}
