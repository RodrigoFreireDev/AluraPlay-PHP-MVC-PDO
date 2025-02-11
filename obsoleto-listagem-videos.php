<?php

use Alura\Mvc\Repository\VideoRepository;

// echo 'AQUI 004</br></br>';
// // var_dump($pdo);
// echo "</br></br>";
// var_dump(new VideoRepository($pdo));
// exit;
$repository = new VideoRepository($pdo);
// if (isset($repository = new VideoRepository($pdo))) {
//     echo 'AQUI 001</br></br>';
//     // // var_dump($pdo);
//     // echo "</br></br>";
//     // var_dump(new VideoRepository($pdo));
//     exit;
// } else {
//     echo 'AQUI 002</br></br>';
//     // // var_dump($pdo);
//     // echo "</br></br>";
//     // var_dump(new VideoRepository($pdo));
//     exit;
// }


$videoList = $repository->allVideos();

?><?php require_once 'inicio-html.php'; ?>
    <ul class="videos__container" alt="videos alura">
        <?php foreach ($videoList as $video) { ?>
            <?php if (!str_starts_with($video->url, 'http')) {
                $video->setUrl('https://www.svgrepo.com/show/349637/trash.svg');
            } ?>
                <li class="videos__item">
                    <iframe width="100%" height="72%" src="<?= $video->url ?>"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
                    <div class="descricao-video">
                        <img src="./img/logo.png" alt="logo canal alura">
                        <h3><?= $video->title ?></h3>
                        <div class="acoes-video">
                            <a href="/edita-video?id=<?= $video->id ?>">Editar(Obsoleto)</a>
                            <a href="/remover-video?id=<?= $video->id ?>">Excluir(Obsoleto)</a>
                        </div>
                    </div>
                </li>
        <?php } ?>
    </ul>
<?php require_once 'fim-html.php'; ?>
