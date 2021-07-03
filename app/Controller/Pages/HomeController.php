<?php

namespace App\Controller\Pages;

use App\Core\Controller;
use App\Core\View;
use App\Model\Estado;
use App\Model\Periodo;

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
        $content = View::render('pages/home', [
            'itensEstados' => self::getEstadosItens(),
            'itensPeriodos' => self::getPeriodosItens(),
        ]);

        /* retorna a view da página */
        return parent::getPage('Mini Framework Php - Home', $content);
    }

    /**
     * Método responsável por obter a renderização dos itens da Model Estado
     *
     * @return string
     */
    private static function getEstadosItens()
    {
        $itens = '';

        /* resultados da página */
        $results = Estado::getEstados('idPais = 1');

        /* renderiza o item */
        while ($objEstado = $results->fetchObject(Estado::class)) {
            $itens .= View::render('pages/itemEstado', [
                'id' => $objEstado->id,
                'idPais' => $objEstado->idPais,
                'descricao' => $objEstado->descricao,
                'sigla' => $objEstado->sigla,
            ]);
        }

        /* retorna a lista de estados */
        return $itens;
    }

    /**
     * Método responsável por obter a renderização dos itens da Model Periodo
     *
     * @return string
     */
    private static function getPeriodosItens()
    {
        $itens = '';

        /* resultados da página */
        $results = Periodo::getPeriodos(null, 'descricao');

        /* renderiza o item */
        while ($objPeriodo = $results->fetchObject(Periodo::class)) {
            $itens .= View::render('pages/itemPeriodo', [
                'id' => $objPeriodo->id,
                'descricao' => $objPeriodo->descricao,
            ]);
        }

        /* retorna a lista de períodos */
        return $itens;
    }
}
