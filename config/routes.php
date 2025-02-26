<?php

use Alura\Mvc\Controller\AboutMvcController;
use Alura\Mvc\Controller\AboutUsController;
use Alura\Mvc\Controller\DeleteVideoController;
use Alura\Mvc\Controller\EditVideoController;
use Alura\Mvc\Controller\JsonVideoListController;
use Alura\Mvc\Controller\LoginController;
use Alura\Mvc\Controller\LoginFormController;
use Alura\Mvc\Controller\LogoutController;
use Alura\Mvc\Controller\NewJsonVideoController;
use Alura\Mvc\Controller\NewVideoController;
use Alura\Mvc\Controller\ThumbnailRemoverConrtoller;
use Alura\Mvc\Controller\VideoFormController;
use Alura\Mvc\Controller\VideoListController;

return [
    'GET|/' => VideoListController::class,
    'GET|/sobre-mvc' => AboutMvcController::class,
    'GET|/novo-video' => VideoFormController::class,
    'POST|/novo-video' => NewVideoController::class,
    'GET|/edita-video' => VideoFormController::class,
    'POST|/edita-video' => EditVideoController::class,
    'GET|/remover-video' => DeleteVideoController::class,
    'GET|/login' => LoginFormController::class,
    'POST|/login' => LoginController::class,
    'GET|/logout' => LogoutController::class,
    'GET|/remover-capa' => ThumbnailRemoverConrtoller::class,
    'GET|/videos-json' => JsonVideoListController::class,
    'POST|/videos' => NewJsonVideoController::class,
];