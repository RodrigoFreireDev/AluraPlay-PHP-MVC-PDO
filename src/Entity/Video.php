<?php

namespace Alura\Mvc\Entity;

use InvalidArgumentException;

class Video
{
    public readonly string $id;
    public readonly string $url;
    private ?string $filePath = null;

    public function __construct(
        string $url,
        public readonly string $title
    ) {
        $this->setUrl($url);
    }

    public function setUrl(string $url): void
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException();
        }

        $this->url = $url;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }
    
    public function setFilePath(string $filePath): void
    {
        $this->filePath = $filePath;
    }

    function gerarSlug($nomeArquivo): string
    {
        // Separar o nome da extensão
        $extensao = pathinfo($nomeArquivo, PATHINFO_EXTENSION);
        $nomeBase = pathinfo($nomeArquivo, PATHINFO_FILENAME);
        
        // 1. Converter para minúsculas
        $slug = strtolower($nomeBase);
        
        // 2. Substituir espaços e traços múltiplos por um único traço
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        
        // 3. Remover acentos
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $slug);
        
        // 4. Remover caracteres que não sejam letras, números ou hifens
        $slug = preg_replace('/[^a-z0-9\-]/', '', $slug);
        
        // 5. Garantir que não haja traços no início ou final
        $slug = trim($slug, '-');
    
        // Retornar o slug concatenado com a extensão original
        return $slug . '.' . $extensao;
    }
}