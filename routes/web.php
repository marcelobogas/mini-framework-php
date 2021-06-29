<?php

use App\Controller\Pages\HomeController;
use App\Controller\Auth\LoginController;
use App\Controller\Auth\ResetPasswordController;
use App\Http\Response;

$objRouter->get('/', [
    function () {
        return new Response(200, HomeController::getHome());
    }
]);

$objRouter->get('/pagina/{idPagina}/{acao}', [
    function ($idPagina, $acao) {
        return new Response(200, 'pagina ' . $idPagina . ' - ' . $acao);
    }
]);

$objRouter->get('/login', [
    function () {
        return new Response(200, LoginController::getLogin());
    }
]);

$objRouter->get('/reset-password', [
    function () {
        return new Response(200, ResetPasswordController::getResetPassword());
    }
]);
