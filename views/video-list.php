<?php

$this->layout('layout');
// $this->insert('/inicio-html');
// Indica que essa var existe sim e o tipo dela.
/**@var Alura\Mvc\Entity\Video[] $videoList */
?>
<ul class="videos__container" alt="videos alura">
    <?php foreach ($videoList as $video) { ?>
        <?php 
            // if (!str_starts_with($video->url, 'http')) {
            //     $video->setUrl('https://www.svgrepo.com/show/349637/trash.svg');
            // }
        ?>
        <li class="videos__item">
            <?php if ($video->getFilePath() !== null): ?>
                <a href="<?= $video->url ?>">
                    <img src="<?= '/img/uploads/'.$video->getFilePath() ?>" alt="" style="width: 100%; height: 50%;">
                </a>
            <?php else: ?>
            <iframe width="100%" height="72%" src="<?= $video->url ?>"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
            <?php endif; ?>
            <div class="descricao-video">
                <img src="./img/logo.png" alt="logo canal alura">
                <h3><?= $video->title ?></h3>
                <div class="acoes-video">
                    <a href="/edita-video?id=<?= $video->id ?>">Editar</a>
                    <a href="/remover-capa?id=<?= $video->id ?>">Remove Capa</a>
                    <a href="/remover-video?id=<?= $video->id ?>">Excluir</a>
                </div>
            </div>
        </li>
    <?php } ?>
</ul>
