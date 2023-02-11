<?php

if (!isset($_SESSION)) {
    session_start();
}

$dbPath = __DIR__ . '/db.sqlite';
$pdo = new PDO("sqlite:{$dbPath}");

if (!isset($_POST)) {
    $_SESSION['save']['status'] = false;
    $_SESSION['save']['message'] = "Erro ao enviar o formulário";
    header('Location: index.php');    
}

$stmt = $pdo->prepare('INSERT INTO videos (url, title) VALUES (?,?);');
$stmt->bindValue(1, $_POST['url']);
$stmt->bindValue(2, $_POST['titulo']);
$resp = $stmt->execute();

$_SESSION['save']['status'] = $resp;
if ($resp) {
    $_SESSION['save']['message'] = "Video Cadastrado com Sucesso!";
    header('Location: index.php');
} else {
    $_SESSION['save']['message'] = "Erro ao Cadastrar o Vídeo";
    header('Location: index.php');
}