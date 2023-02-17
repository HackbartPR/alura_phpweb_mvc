<?php

require_once __DIR__ . '/../vendor/autoload.php';

$path = $_SERVER['PATH_INFO'];
$method = $_SERVER['REQUEST_METHOD'];

if ($path === '/' || !array_key_exists('PATH_INFO', $_SERVER)) {
    require_once __DIR__ . '/../pages/show-videos.php';
} else if ($path === '/novo') {
    if ($method === 'GET') {
        require_once __DIR__ . '/../pages/enviar-video.php';
    } else if ($method === 'POST') {
        require_once __DIR__ . '/../novo-video.php';
    }
} else if ($path === '/editar') {
    if ($method === 'GET') {
        require_once __DIR__ . '/../pages/enviar-video.php';
    } else if ($method === 'POST') {
        require_once __DIR__ . '/../atualizar-video.php';
    }
} else if ($path === '/remover') {
    require_once __DIR__ . '/../remover-video.php';
} else {
    http_response_code(404);
}