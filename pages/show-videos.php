<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    use HackbartPR\Config\ConnectionCreator;
    use HackbartPR\Repository\PDOVideoRepository;
    
    $conn = ConnectionCreator::createConnection();
    $repository = new PDOVideoRepository($conn);
    $videoList = $repository->all();
?>

<?php require_once __DIR__ . '/../components/header.php'; ?>

<ul class="videos__container" alt="videos alura">
    <?php foreach ($videoList as $video) : ?>
        <li class="videos__item">
            <iframe width="100%" height="72%" src="<?= $video->url ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div class="descricao-video">
                <img src="./img/logo.png" alt="logo canal alura">
                <h3><?= $video->title ?></h3>
                <div class="acoes-video">
                    <a href="/editar?id=<?= $video->id() ?>">Editar</a>
                    <a href="/remover?id=<?= $video->id() ?>">Excluir</a>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

<!-- Resposta -->
<?php if (isset($_SESSION['save'])) : ?>
    <?php if ($_SESSION['save']['status']) { ?>
        <div class='message success'>
            <?= $_SESSION['save']['message']; ?>
        </div>
    <?php } else { ?>
        <div class='message error'>
            <?= $_SESSION['save']['message']; ?>
        </div>
    <?php } ?>
    <?php session_destroy(); ?>
<?php endif; ?>

<?php require_once __DIR__ . '/../components/footer.php'; ?>