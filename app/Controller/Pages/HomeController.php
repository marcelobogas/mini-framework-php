<?php

namespace App\Controller\Pages;

use App\Core\Controller;
use App\Core\View;

class HomeController extends Controller
{
    /**
     * Método responsável por retornar uma view
     *
     * @return string
     */
    public static function getHome()
    {
        /* view da home */
        $content = View::render('pages/home', []);

        /* retorna a view da página */
        return parent::getPage('Mini Framework Php - Home', $content);
    }
}
