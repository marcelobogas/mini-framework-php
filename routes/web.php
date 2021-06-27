<?php

use App\Controller\Pages\HomeController;
use App\Http\Response;

$objRouter->get('/', [
    function () {
        return new Response(200, HomeController::getHome());
    }
]);

$objRouter->get('/pagina/{idPagina}/{acao}', [
    function ($idPagina, $acao) {
        return new Response(200, 'Pagina ' . $idPagina . ' - ' . $acao);
    }
]);
