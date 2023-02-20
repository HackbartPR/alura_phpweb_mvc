<?php

namespace HackbartPR\Controller;

use HackbartPR\Interfaces\Controller;
use HackbartPR\Repository\PDOVideoRepository;

class SendVideoController implements Controller
{
    private PDOVideoRepository $repository;

    public function __construct(PDOVideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function processRequest(): void
    {
        [$id] = $this->validation();

        $video = null;
        if ($id) {
            $video = $this->repository->show($id);
        }
                
        require_once __DIR__ . '/../../components/header.php'; ?>
        <main class="container">
            <?php if ($video) { ?>

                <form class="container__formulario" method="POST" action="/editar?id=<?= $video->id() ?>">
                    <h2 class="formulario__titulo"><?= $video->title ?></h2>

                    <div class="formulario__campo">
                        <label class="campo__etiqueta" for="url">Link embed</label>
                        <input name="url" class="campo__escrita" required placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" id='url' value='<?= $video->url ?>' />
                    </div>


                    <div class="formulario__campo">
                        <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                        <input name="titulo" class="campo__escrita" required placeholder="Neste campo, dê o nome do vídeo" id='titulo' value='<?= $video->title ?>' />
                    </div>

                    <input class="formulario__botao" type="submit" value="Atualizar" />
                </form>

            <?php } else { ?>

                <form class="container__formulario" method="POST" action="/novo">
                    <h2 class="formulario__titulo">Envie um vídeo!</h2>

                    <div class="formulario__campo">
                        <label class="campo__etiqueta" for="url">Link embed</label>
                        <input name="url" class="campo__escrita" required placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" id='url' />
                    </div>


                    <div class="formulario__campo">
                        <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                        <input name="titulo" class="campo__escrita" required placeholder="Neste campo, dê o nome do vídeo" id='titulo' />
                    </div>

                    <input class="formulario__botao" type="submit" value="Enviar" />
                </form>

            <?php } ?>
        </main>

        <?php require_once __DIR__ . '/../../components/footer.php';
    }

    private function validation(): array
    {
        $id = null;
        if (isset($_GET['id'])) {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);            
        }

        return [$id];        
    }
}