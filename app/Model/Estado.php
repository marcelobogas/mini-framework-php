<?php

namespace App\Model;

use App\Core\Database;
use PDO;

class Estado
{
    /**
     * Método responsável por obter os registros no banco
     *
     * @param string $where
     * @param string $order
     * @param string $limit
     *
     * @return PDOStatement
     */
    public static function getEstados($where = null, $order = null, $limit = null, $fields = ' * ')
    {
        return (new Database('estados'))->select($where, $order, $limit, $fields);
    }
}
