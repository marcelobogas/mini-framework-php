<?php

namespace App\Controller\Auth;

use App\Core\Controller;
use App\Core\View;

class ResetPasswordController extends Controller
{
    /**
     * Método responsável por retornar uma view
     *
     * @return string
     */
    public static function getResetPassword()
    {
        /* view da home */
        $content = View::render('auth/resetPassword', []);

        /* retorna a view da página */
        return parent::getPage('Mini Framework Php - Reset Password', $content);
    }
}
