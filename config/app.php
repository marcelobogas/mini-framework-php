<?php 

use App\Core\Enviroments;
use App\Core\View;

 /* Carrega as variáveis de ambiente */
Enviroments::load(__DIR__);

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
