<?php

namespace App\Model;

use App\Core\Database;

class Periodo
{    
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
