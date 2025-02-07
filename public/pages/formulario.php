<?php

use Alura\Mvc\Repository\VideoRepository;

$action = "/novo-video";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$repository = new VideoRepository($pdo);

if (isset($id)) {
    $action = "edita-video?id=".$id;

    $video = $repository->videoById($id);
}

?>
<?php require __DIR__.'/../../inicio-html.php'; ?>

    <main class="container">

        <form class="container__formulario" action="<?= $action ?>" method="post">
            <h2 class="formulario__titulo">Envie um vídeo!</h2>
                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="url">Link embed</label>
                    <input
                        name="url"
                        value="<?= $video->url ?>"
                        class="campo__escrita"
                        required
                        placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" id='url' 
                    />
                </div>

                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                    <input name="titulo" class="campo__escrita" required placeholder="Neste campo, dê o nome do vídeo"
                        id='titulo' value="<?= $video->title ?>"/>
                </div>

                <input class="formulario__botao" type="submit" value="Enviar" />
        </form>

    </main>
<?php require_once __DIR__.'/../../inicio-html.php'; ?>
