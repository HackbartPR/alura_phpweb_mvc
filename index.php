<?php 
    if (!isset($_SESSION)) {
        session_start();
    }

    $dbPath = __DIR__ . '/db.sqlite';
    $pdo = new PDO("sqlite:{$dbPath}");
    $stmt = $pdo->query('SELECT * FROM videos');
    $videosList = $stmt->fetchAll(\PDO::FETCH_ASSOC);
?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/flexbox.css">
    <title>AluraPlay</title>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
</head>

<body>

    <header>

        <nav class="cabecalho">
            <a class="logo" href="./index.php"></a>

            <div class="cabecalho__icones">
                <a href="./pages/enviar-video.php" class="cabecalho__videos"></a>
                <a href="./pages/login.html" class="cabecalho__sair">Sair</a>
            </div>
        </nav>

    </header>

    

    <ul class="videos__container" alt="videos alura">
        <?php foreach ($videosList as $video): ?>
            <!-- <?php if(str_starts_with($video['url'], 'http') || str_starts_with($video['url'], 'https')): ?> -->
                <li class="videos__item">
                    <iframe width="100%" height="72%" src="<?=$video['url']?>"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                    <div class="descricao-video">
                        <img src="./img/logo.png" alt="logo canal alura">
                        <h3><?=$video['title']?></h3>
                        <div class="acoes-video">
                            <a href="./pages/enviar-video.php?id=<?=$video['id']?>">Editar</a>
                            <a href="./pages/remover-video.php?id=<?=$video['id']?>">Excluir</a>
                        </div>
                    </div>
                </li>
            <!-- <?php endif; ?> -->
        <?php endforeach; ?>        
    </ul>

    <!-- Resposta -->
    <?php if(isset($_SESSION['save'])):?>
        <?php if ($_SESSION['save']['status']) {?>
            <div class='message success'>
                <?=$_SESSION['save']['message'];?>
            </div>
        <?php } else { ?>
            <div class='message error'>
                <?=$_SESSION['save']['message'];?>
            </div>
        <?php } ?>
        <?php session_destroy(); ?>
    <?php endif; ?>
</body>

</html>