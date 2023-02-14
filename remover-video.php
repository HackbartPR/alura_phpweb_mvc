<?php

if (!isset($_SESSION)) {
    session_start();
}

$dbPath = __DIR__ . '/db.sqlite';
$pdo = new PDO("sqlite:{$dbPath}");

if (!isset($_GET['id'])) {
    $_SESSION['save']['status'] = false;
    $_SESSION['save']['message'] = "Livro não informado!";
    header('Location: /');    
}

$stmt = $pdo->prepare('DELETE FROM videos WHERE id = ?');
$stmt->bindValue(1, $_GET['id'], \PDO::PARAM_INT);
$result = $stmt->execute();

$_SESSION['save']['status'] = $result;
if ($result) {
    $_SESSION['save']['message'] = "Livro excluído com sucesso!";
    header('Location: /');
} else {
    $_SESSION['save']['message'] = "Livro não pode ser excluído, tente novamente!";
    header('Location: /');
}
