<?php

namespace Alura\Mvc\Repository;

use Alura\Mvc\Entity\Video;
use PDO;

class VideoRepository
{
    public function __construct(private PDO $pdo)
    {
        
    }

    public function addVideo(Video $video): bool
    {
        $sql = "INSERT INTO videos (url, title, image_path) VALUES (?, ?, ?);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $video->url);
        $stmt->bindValue(2, $video->title);
        $stmt->bindValue(3, $video->getFilePath());

        $result = $stmt->execute(); // Falta verificação de sucesso ou erro(Nesse caso lançar execptions - Desafio aluno)

        // Antes
        // $video->setId($this->pdo->lastInsertId()); //Recebemos uma mensagem de alerta, porque o lastInsertId() pode retornar outras classes.

        // Depois
        $id = $this->pdo->lastInsertId();  // Vamos extraí-lo para uma variável, como $id. Em setId() nós chamaremos intval($id).
        $video->setId(intval($id));// Assim, garantimos que o resultado será um número inteiro.
        // intval() — Obtém o valor em número inteiro de uma variável

        return $result;
    }

    public function removeVideo(int $id): bool
    {
        $sql = 'DELETE FROM videos WHERE id = ?;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function updateVideo(Video $video): bool
    {   
        $updateImageSql = '';
        if ($video->getFilePath() !== null) {
            $updateImageSql = ', image_path = :image_path';
        }
        
        $sql = "UPDATE videos SET
                url = :url,
                title = :title
                $updateImageSql
                WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':url', $video->url);
        $stmt->bindValue(':title', $video->title);
        $stmt->bindValue(':id', $video->id, PDO::PARAM_INT);

        if ($video->getFilePath() !== null) {
            $stmt->bindValue(':image_path', $video->getFilePath());
        }

        return $stmt->execute();
    }

    /**
     * @return Video[]
     */
    public function allVideos(): array
    {
        // $sql = 'SELECT * FROM videos;';
        // $stmt = $this->pdo->query($sql);
        // $videoList = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // $videoList: Array Associativo simples!
        $videoList = $this->pdo
            ->query('SELECT * FROM videos;')
            ->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            function(array $videoData) {
                // new Video(...$videoData); // Essa sintaxe '...$videoData': utilizar os parâmetros nomeados do PHP e cada chave do array será igual ao nome do parâmetro.
                $video = new Video($videoData['url'], $videoData['title']); // Nós tentamos passar um parâmetro id para o Video, mas esse parâmetro não existe. Por isso, voltaremos à forma manual.
                $video->setId($videoData['id']);
                if ($videoData['image_path'] !== null) {
                    $video->setFilePath($videoData['image_path']);
                }

                return $video;
            },
            $videoList
        );
    }

    public function videoById(int $id): Video
    {
        $sql = 'SELECT * FROM videos WHERE id = ?;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $video = $stmt->fetch(PDO::FETCH_ASSOC);
        $result = new Video($video['url'], $video['title']);

        return $result;
    }

    public function thumbnailRemover(int $id): bool
    {
        $sql = 'UPDATE videos SET image_path = null WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        
        return $stmt->execute();
    }
}
