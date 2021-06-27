<?php

use App\Http\Router;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/app.php';

/* Inicia o Router */
$objRouter = new Router(url);

/* Inclui as rotas de páginas */
include __DIR__ . '/routes/web.php';

$objRouter->run()->sendResponse();
