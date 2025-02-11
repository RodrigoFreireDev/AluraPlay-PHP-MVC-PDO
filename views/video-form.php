<?php

require __DIR__ . '/inicio-html.php';
// Indica que essa var existe sim. Alem de tipo e que pode ser null
//** @var ?\Alura\Mvc\Entity\Video $video */
// OU mais 'explicito'
/**@var \Alura\Mvc\Entity\Video|null $video */
?>
<main class="container">

    <form class="container__formulario" action="<?= $action ?>" method="post">
        <h2 class="formulario__titulo">Envie um vídeo!(NOVO)</h2>
        <div class="formulario__campo">
            <label class="campo__etiqueta" for="url">Link embed</label>
            <input
                name="url"
                value="<?= $video?->url ?>"
                class="campo__escrita"
                required
                placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" id='url' />
        </div>
        <div class="formulario__campo">
            <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
            <input
                name="titulo"
                value="<?= $video?->title ?>"
                class="campo__escrita"
                required placeholder="Neste campo, dê o nome do vídeo"
                id='titulo' />
        </div>

        <input class="formulario__botao" type="submit" value="Enviar" />
    </form>

</main>

<?php

require_once __DIR__ . '/inicio-html.php';
