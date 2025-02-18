<?php

use DI\ContainerBuilder;

use function DI\create;

$builder = new ContainerBuilder();
$builder->addDefinitions([
    // Via Factories
    // PDO::class => function(): PDO {
    //     return new PDO('mysql:host=localhost;dbname=aluraplay;charset=utf8mb4', 'root', 'Root@123');
    // }

    // Via Objects
    PDO::class => create(PDO::class)->constructor('mysql:host=localhost;dbname=aluraplay;charset=utf8mb4', 'root', 'Root@123')
]);

/** @var \ContainerInterface $container */
$container = $builder->build();

return $container;
