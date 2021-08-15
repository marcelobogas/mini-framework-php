<?php

namespace App\Controller\Admin;

use App\Core\Controller;
use App\Core\View;
use App\Model\Curso;
use App\Http\Request;
use App\Model\Periodo;

class CursoController extends Controller
{
    /**
     * Método responsável por retornar a view de Cursos
     * 
     * @param  Request $request
     * @return string
     */
    public static function getCurso($request)
    {
        /* view de cursos */
        $content = View::render('pages/curso/home', [
            'itens'        => self::getCursoItens($request),
            'itensPeriodo' => self::getPeriodosItens(),
        ]);

        /* retorna a view da página */
        return parent::getPage('Mini Framework Php - Cursos', $content);
    }

    /**
     * Método responsável por obter os dados do formulário via POST
     *
     * @param Request $request
     *
     * @return string
     */
    public static function cursoPesquisar($request)
    {
        $itens = '';

        /* dados do POST */
        $postVars = $request->getPostVars();

        $filtroPesquisa = $postVars['inputPesquisa'] ?? '';
        $filtroPeriodo  = $postVars['periodo'] ?? '';
        $filtroStatus   = $postVars['status'] ?? '';

        $condicoes = [
            strlen($filtroPesquisa) ? 'descricao like "%' . str_replace(' ', '%', $filtroPesquisa) . '%"' : null,
            strlen($filtroPeriodo) ? 'idPeriodo = ' . $filtroPeriodo  : null,
            strlen($filtroStatus) ? 'ativo = "' . $filtroStatus . '"' : null,
        ];

        /* remove as posições vazias do array */
        $condicoes = array_filter($condicoes);

        /* cláusulas where */
        $where = implode(' AND ', $condicoes);

        /* resultados da página */
        $results = Curso::getCursos($where, 'descricao', null, '*');

        /* renderiza o item */
        while ($objCurso = $results->fetchObject(Curso::class)) {
            /* obtém o período referente ao curso */
            $resultPeriodo = Periodo::getPeriodos('id = ' . $objCurso->idPeriodo, null, null, '*');
            $objPeriodo = $resultPeriodo->fetchObject(Periodo::class);

            $itens .= View::render('pages/curso/table', [
                'id'               => $objCurso->id,
                'idPeriodo'        => $objCurso->idPeriodo,
                'descricao'        => $objCurso->descricao,
                'ativo'            => $objCurso->ativo == 's' ? 'Ativo' : 'Inativo',
                'descricaoPeriodo' => $objPeriodo->descricao,
            ]);
        }

        /* view de cursos */
        $content = View::render('pages/curso/home', [
            'itens' => $itens,
            'itensPeriodo' => self::getPeriodosItens(),
        ]);

        /* retorna a view da página */
        return parent::getPage('Mini Framework Php - Cursos', $content);
    }

    /**
     * Método responsável por retornar todos os registros
     *
     * @param Request $request 
     *
     * @return string
     */
    public static function getCursoItens($request)
    {
        $itens = '';

        /* Quantidade de registros */
        $qtdeTotal = Curso::getCursos(null, null, null, 'COUNT(*) as qtde')->fetchObject()->qtde;

        /* obtem a página atual */
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        /* Instância de Paginação */
        //$objPagination = new Pagination($qtdeTotal, $paginaAtual, 5);

        /* resultados da página */
        $results = Curso::getCursos(null, 'descricao', null, '*');

        /* renderiza o item */
        while ($objCurso = $results->fetchObject(Curso::class)) {
            /* obtém o período referente ao curso */
            $resultPeriodo = Periodo::getPeriodos('id = ' . $objCurso->idPeriodo, null, null, '*');
            $objPeriodo = $resultPeriodo->fetchObject(Periodo::class);

            $itens .= View::render('pages/curso/table', [
                'id'               => $objCurso->id,
                'idPeriodo'        => $objCurso->idPeriodo,
                'descricao'        => $objCurso->descricao,
                'ativo'            => $objCurso->ativo == 's' ? 'Ativo' : 'Inativo',
                'descricaoPeriodo' => $objPeriodo->descricao,
            ]);
        }

        /* retorna a lista de cursos */
        return $itens;
    }

    /**
     * Método responsável por inserir um registro no banco
     * 
     * @param  Request $request
     * @return string
     */
    public static function insertCurso($request)
    {
        /* dados do POST */
        $postVars = $request->getPostVars();

        $objCurso            = new Curso();
        $objCurso->idPeriodo = $postVars['idPeriodo'];
        $objCurso->descricao = $postVars['descricao'];
        $objCurso->ativo     = $postVars['ativo'];
        $objCurso->cadastrar();

        /* retorna a listagem da página Cursos */
        return self::getCurso($request);
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
            $itens .= View::render('pages/curso/itemPeriodo', [
                'id' => $objPeriodo->id,
                'descricao' => $objPeriodo->descricao,
            ]);
        }

        /* retorna a lista de períodos */
        return $itens;
    }
}
