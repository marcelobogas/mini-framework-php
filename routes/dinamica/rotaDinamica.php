<?php

use App\Http\Response;

/* Rota dinâmica */
$objRouter->get('/pagina/{vars}/{acao}', [
    function ($vars, $acao) {
        return new Response(200, 'Página - ' . $vars . ' - ' . $acao);
    }
]);