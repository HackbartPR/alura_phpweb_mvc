<?php

if (!isset($_SESSION)) {
    session_start();
}

$dbPath = __DIR__ . '/../db.sqlite';
$pdo = new PDO("sqlite:{$dbPath}");

if (!isset($_POST)) {
    $_SESSION['save']['status'] = false;
    $_SESSION['save']['message'] = "Erro ao enviar o formulário";
    header('Location: ../index.php');    
    exit();
}

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$title = filter_input(INPUT_POST, 'titulo');

if (!$url) {
    $_SESSION['save']['status'] = false;
    $_SESSION['save']['message'] = "URL não é válida";
    header('Location: ../index.php');    
    exit();
}

if (!$title) {
    $_SESSION['save']['status'] = false;
    $_SESSION['save']['message'] = "Título não é valido";
    header('Location: ../index.php');    
    exit();
}

$stmt = $pdo->prepare('INSERT INTO videos (url, title) VALUES (?,?);');
$stmt->bindValue(1, $url);
$stmt->bindValue(2, $title);
$resp = $stmt->execute();

$_SESSION['save']['status'] = $resp;
if ($resp) {
    $_SESSION['save']['message'] = "Video Cadastrado com Sucesso!";
    header('Location: ../index.php');
} else {
    $_SESSION['save']['message'] = "Erro ao Cadastrar o Vídeo";
    header('Location: ../index.php');
}