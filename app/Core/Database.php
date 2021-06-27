<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    /**
     * Credenciais de acesso para o banco de dados
     */
    const HOST = 'localhost';
    const DBNAME = 'mini-framework-php';
    const USER = 'root';
    const PASS = '';
    const PORT = 3306;

    /**
     * Nome da tabela a ser manipulada
     *
     * @var string
     */
    private $table;

    /**
     * armazena uma instância de conexão com o banco de dados
     *
     * @var PDO
     */
    private $connection;

    /**
     * Método construtor da classe
     *
     * @return Connection
     */
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Método responsável por setar as configurações da conexão com o banco
     *
     * @return void
     */
    private function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host' . self::HOST . ';dbname=' . self::DBNAME . ';port=' . self::PORT, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die('ERROR: ' . $ex->getMessage());
        }
    }

    /**
     * Método responsável por executar queries dentro do banco de dados
     * @param  string $query
     * @param  array  $params
     * @return PDOStatement
     */
    public function execute($query, $params = [])
    {
      try {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);
      } catch (PDOException $e) {
        die('ERROR: ' . $e->getMessage());
      }
    }

    /**
     * Método responsável por inserir um registro no banco de dados
     *
     * @param array $values | field => value
     *
     * @return integer
     */
    public function insert($values)
    {
        /* dados da query */
        $fields = array_values($values);
        $binds = array_pad([], count($fields), '?');

        /* monta a query */
        $query = 'INSERT INTO ' . $this->table . '(' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';

        /* exxecuta o insert */
        $this->execute($query, array_values($values));

        /* retorna o id inserido */
        return $this->connection->lastInsertId();
    }

    /**
     * Método responsável por executar uma consulta no banco
     * @param  string $where
     * @param  string $order
     * @param  string $limit
     * @param  string $field
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
      /* dados da query */
      $where = strlen($where) ? 'WHERE' . $where : '';
      $order = strlen($order) ? 'ORDER BY' . $order : '';
      $limit = strlen($limit) ? 'LIMIT' . $limit : '';

      /* monta a query */
      $query = 'SELECT ' . $fields . 'FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

      /* executa a query */
      return $this->execute($query);
    }

    /**
     * Método responsável por executar atualiozações no banco de dados
     * @param  string $where
     * @param  array $values [field => value]
     * @return boolean
     */
    public function update($where, $values)
    {
      /* dados da query */
      $fields = array_values($values);

      /* monta a query */
      $query = 'UPDATE ' . $this->table . 'SET ' . implode(' = ?,', $fields) . ' = ? WHERE ' . $where;

      /* executa a query */
      $this->execute($query, array_values($values));

      /* retorna successo */
      return true;
    }

    /**
     * Método responsável por excluir dados do banco
     * @param  string $where
     * @return boolean
     */
    public function delete($where)
    {
      /* monta a query */
      $query = 'DELETE FROM ' . $this->table . 'WHERE ' . $where;

      /* executa a query */
      $this->execute($query);

      /* retorna successo */
      return true;
    }
}
