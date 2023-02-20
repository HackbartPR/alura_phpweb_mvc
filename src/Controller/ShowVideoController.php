<?php

namespace HackbartPR\Controller;

use HackbartPR\Interfaces\Controller;
use HackbartPR\Repository\PDOVideoRepository;

class ShowVideoController implements Controller
{
    private PDOVideoRepository $repository;

    public function __construct(PDOVideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function processRequest(): void
    {
        $videoList = $this->repository->all();        
                
        require_once __DIR__ . '/../../components/header.php'; ?>

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

        <?php require_once __DIR__ . '/../../components/footer.php';

        $this->showMessages();
    }
    
    private function showMessages(): void
    {
        if (isset($_SESSION['save'])) {
            if ($_SESSION['save']['status']) { ?>
                <div class='message success'>
                    <?= $_SESSION['save']['message']; ?>
                </div> <?php            
            } else { ?>
                <div class='message error'>
                    <?= $_SESSION['save']['message']; ?>
                </div> <?php
            }
            session_destroy();
        }
    }
}