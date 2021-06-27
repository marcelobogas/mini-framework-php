<?php

use App\Core\View;

/* Definições globais utilizadas pelo projeto */
define('url', 'http://localhost/mini-framework-php');
define('database', url . '/database');
define('assets', url . '/public/assets');

 /* Define valores padrão para as páginas ao iniciar o aplicativo */
 View::init([
     'url'     => url,
     'database' => database,
     'assets'  => assets,
 ]);
