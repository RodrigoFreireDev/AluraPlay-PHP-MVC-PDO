<?php

use DI\ContainerBuilder;
use League\Plates\Engine;

use function DI\create;

$builder = new ContainerBuilder();
$builder->addDefinitions([
    // -- Via Factories
    // PDO::class => function(): PDO {
    //     return new PDO('mysql:host=localhost;dbname=aluraplay;charset=utf8mb4', 'root', 'Root@123');
    // }        OU:
    // -- Via Objects
    PDO::class => create(PDO::class)->constructor('mysql:host=localhost;dbname=aluraplay;charset=utf8mb4', 'root', 'Root@123'),

    // -- Via Factories
    Engine::class => function() {
        $templatesPath = __DIR__. '/../views';
        return new Engine($templatesPath);
    },
]);

/** @var \ContainerInterface $container */
$container = $builder->build();

return $container;
