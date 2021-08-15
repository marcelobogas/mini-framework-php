<?php

namespace App\Model;

use App\Core\Database;

class Curso
{
    /**
     * identificador do registro
     * @var integer
     */
    public $id;

    /**
     * identificador chave estrangeira da tabela Periodos
     * @var integer
     */
    public $idPeriodo;

    /**
     * nome do registro
     * @var string
     */
    public $descricao;

    /**
     * identifica se o registro está ativo ou não
     * @var enum (s,n)
     */
    public $ativo;

    /**
     * Método responsável por cadastrar um novo registro no banco
     *
     * @return boolean
     */
    public function cadastrar()
    {
        /* insere um registro no banco */
        $this->id = (new Database('cursos'))->insert([
            'idPeriodo' => $this->idPeriodo,
            'descricao' => $this->descricao,
            'ativo' => $this->ativo
        ]);

        /* retorna sucesso */
        return true;
    }

    /**
     * Método responsável por obter os registros do banco
     *
     * @param  string $where
     * @param  string $order
     * @param  string $limit
     * @param  string $fields
     *
     * @return PDOStatement
     */
    public static function getCursos($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('cursos'))->select($where, $order, $limit, $fields);
    }
}
