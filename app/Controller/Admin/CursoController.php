<?php

namespace App\Controller\Admin;

use App\Core\Controller;
use App\Core\View;
use App\Model\Curso;
use App\Http\Request;

class CursoController extends Controller
{
    /**
     * Método responsável por retornar a view de Cursos
     * @param  Request $request
     * @return string
     */
    public static function getCurso($request)
    {
        /* view de cursos */
        $content = View::render('pages/curso/home',[
            'itens' => self::getCursosItems($request),
        ]);

        /* retorna a view da página */
        return parent::getPage('Mini Framework Php - Cursos', $content);
    }

    /**
     * Método responsável por obter a renderização dos itens da Model Curso
     * @param Request $request
     * @return string
     */
    private static function getCursosItems($request)
    {
        $itens = '';

        /* Quantidade de registros */
        $qtdeTotal = Curso::getCursos(null, null, null, 'COUNT(*) as qtde')->fetchObject()->qtde;

        /* obtem a página atual */
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        /* Instância de Paginação */
        //$objPagination = new Pagination($qtdeTotal, $paginaAtual, 15);

        /* resultados da página */
        $results = Curso::getCursos('ativo = "s"', 'descricao');

        /* renderiza o item */
        while ($objCurso = $results->fetchObject(Curso::class)) {
            $itens .= View::render('pages/itemEstado', [
                'id' => $objCurso->id,
                'idPeriodo' => $objCurso->idPeriodo,
                'descricao' => $objCurso->descricao,
                'ativo' => $objCurso->ativo
            ]);
        }

        /* retorna a lista de estados */
        return $itens;
    }

    /**
     * Método responsável por inserir um registro no banco
     * @param  Request $request
     * @return string
     */
    public static function insertCurso($request)
    {
        /* dados do POST */
        $postVars = $request->getPostVars();

        $objCurso = new Curso();
        $objCurso->idPeriodo = $postVars['idPeriodo'];
        $objCurso->descricao = $postVars['descricao'];
        $objCurso->ativo = $postVars['ativo'];
        $objCurso->cadastrar();

        /* retorna a listagem da página Cursos */
        return self::getCurso($request);
    }

    public static function editCurso()
    {

    }

    public static function updateCurso($id)
    {

    }

    public static function deleteCurso($id)
    {

    }
}
