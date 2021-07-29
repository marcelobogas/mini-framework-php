<?php

use App\Controller\Pages\HomeController;
use App\Http\Response;

/* Rota da Home */
$objRouter->get('/', [
    function () {
        return new Response(200, HomeController::getHome());
    }
]);