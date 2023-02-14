<?php

if (!isset($_SESSION)) {
    session_start();
}

$dbPath = __DIR__ . '/db.sqlite';
$pdo = new PDO("sqlite:{$dbPath}");

if (!isset($_POST) || !isset($_GET['id'])) {
    $_SESSION['save']['status'] = false;
    $_SESSION['save']['message'] = "Erro ao enviar o formulário";
    header('Location: /');    
    exit();
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$title = filter_input(INPUT_POST, 'titulo');

if (!$url) {
    $_SESSION['save']['status'] = false;
    $_SESSION['save']['message'] = "URL não é válida";
    header('Location: /');    
    exit();
}

if (!$title) {
    $_SESSION['save']['status'] = false;
    $_SESSION['save']['message'] = "Título não é valido";
    header('Location: /');    
    exit();
}

$stmt = $pdo->prepare('UPDATE videos SET url = :url, title = :title WHERE id = :id;');
$stmt->bindValue(':url', $url);
$stmt->bindValue(':title', $title);
$stmt->bindValue(':id', $id);
$resp = $stmt->execute();

$_SESSION['save']['status'] = $resp;
if ($resp) {
    $_SESSION['save']['message'] = "Video atualizado com sucesso!";
    header('Location: /');
} else {
    $_SESSION['save']['message'] = "Erro ao atualizar o vídeo";
    header('Location: /');
}