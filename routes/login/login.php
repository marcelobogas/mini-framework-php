<?php

use App\Controller\Auth\LoginController;
use App\Controller\Auth\ResetPasswordController;
use App\Http\Response;

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