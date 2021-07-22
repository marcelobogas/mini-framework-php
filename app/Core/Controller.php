<?php

namespace App\Core;

class Controller
{
    /**
     * Método responsável por renderizar o topo da página
     *
     * @return string
     */
    private static function getHeader()
    {
        return View::render('layouts/header', []);
    }

    /**
     * Método responsável por renderizar o footer da página
     *
     * @return string
     */
    private static function getFooter()
    {
        return View::render('layouts/footer', [
            'organization' => 'MB-TECK'
        ]);
    }

    /**
     * Método responsável por retornar uma view
     *
     * @param string $title [recebe o título da página]
     * @param string $content [recebe o conteúdo da página]
     *
     * @return string
     */
    public static function getPage($title, $content)
    {
        return View::render('layouts/app', [
            'title'   => $title,
            'header'  => self::getHeader(),
            'content' => $content,
            'footer'  => self::getFooter()
        ]);
    }
}
