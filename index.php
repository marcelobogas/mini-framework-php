<?php

use App\Http\Router;
use App\Core\Enviroments;

require_once __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/config/app.php';

 /* Carrega as variáveis de ambiente */
Enviroments::load(__DIR__);

/* Inicia o Router */
$objRouter = new Router(url);

/* Inclui as rotas de páginas */
include __DIR__ . '/routes/web.php';

$objRouter->run()->sendResponse();
