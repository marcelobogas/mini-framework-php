<?php

use App\Controller\Pages\HomeController;
use App\Controller\Auth\LoginController;
use App\Controller\Auth\ResetPasswordController;
use App\Http\Response;

/* Rota da Home */
$objRouter->get('/', [
    function () {
        return new Response(200, HomeController::getHome());
    }
]);

/* Rota dinâmica */
$objRouter->get('/pagina/{idPagina}/{acao}', [
    function ($idPagina, $acao) {
        return new Response(200, 'Página ' . $idPagina . ' - ' . $acao);
    }
]);

/* Rota de Login */
$objRouter->get('/login', [
    function () {
        return new Response(200, LoginController::getLogin());
    }
]);

/* Rota para redefinir a senha */
$objRouter->get('/reset-password', [
    function () {
        return new Response(200, ResetPasswordController::getResetPassword());
    }
]);
