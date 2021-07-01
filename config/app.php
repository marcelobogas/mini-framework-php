<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Enviroments;
use App\Core\View;

 /* Carrega as variáveis de ambiente */
 Enviroments::load(__DIR__ . '/../');

 /* Define valores padrão para as páginas ao iniciar o aplicativo */
 View::init([
     'url'     => getenv('APP_URL'),
     'assets'  => getenv('APP_URL') . '/public/assets',
 ]);
