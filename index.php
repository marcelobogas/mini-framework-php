<?php

use App\Http\Router;

include __DIR__ . '/config/app.php';

/* Inicia o Router */
$objRouter = new Router(getenv('APP_URL'));

/* Inclui as rotas de páginas */
include __DIR__ . '/routes/web.php';

$objRouter->run()->sendResponse();
