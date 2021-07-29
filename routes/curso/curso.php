<?php

use App\Controller\Admin\CursoController;
use App\Http\Response;

/* Rota do tipo GET */
$objRouter->get('/cursos', [
    function ($request) {
        return new Response(200, CursoController::getCurso($request));
    }
]);

/* Rota do tipo POST */
$objRouter->post('/cursosPesquisar', [
    function ($request) {
        return new Response(200, CursoController::cursoPesquisar($request));
    }
]);