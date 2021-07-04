<?php

namespace App\Controller\Auth;

use App\Core\Controller;
use App\Core\View;

class LoginController extends Controller
{    
    /**
     * Método responsável por retornar uma view
     *
     * @return string
     */
    public static function getLogin()
    {
        /* view do login */
        $content = View::render('auth/login', []);

        /* retorna a view da página */
        return parent::getPage('Mini Framawork Php - Login', $content);
    }
}
