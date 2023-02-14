<?php

$path = $_SERVER['PATH_INFO'];
$method = $_SERVER['REQUEST_METHOD'];

if ($path === '/' || !array_key_exists('PATH_INFO', $_SERVER)) {
    require_once './pages/show-videos.php';
} else if ($path === '/novo') {
    if ($method === 'GET') {
        require_once './pages/enviar-video.php';
    } else if ($method === 'POST') {
        require_once './novo-video.php';
    }
} else if ($path === '/editar') {
    if ($method === 'GET') {
        require_once './pages/enviar-video.php';
    } else if ($method === 'POST') {
        require_once './atualizar-video.php';
    }
} else if ($path === '/remover') {
    require_once './remover-video.php';
}