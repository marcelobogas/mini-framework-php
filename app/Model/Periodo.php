<?php

namespace App\Model;

use App\Core\Database;

class Periodo
{        
    /**
     * identificador do registro
     *
     * @var integer
     */
    public $id;
    
    /**
     * descricao do período
     *
     * @var string
     */
    public $descricao;

    public function __construct()
    {
        //..
    }

    /**
     * Método responsável por obter os registros no banco
     *
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     *
     * @return PDOStatement
     */
    public static function getPeriodos($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('periodos'))->select($where, $order, $limit, $fields);
    }
}
