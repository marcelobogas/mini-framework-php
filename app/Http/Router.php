<?php

namespace App\Http;

use Closure;
use Exception;

class Router
{
    /**
     * url completa do projeto
     *
     * @var string
     */
    private $url = '';

    /**
     * prefixo de todas as rotas (raiz)
     *
     * @var string
     */
    private $prefix = '';

    /**
     * índices de rotas
     *
     * @var array
     */
    private $routes = [];

    /**
     * Instância de Request
     *
     * @var Request
     */
    private $request;

    public function __construct($url)
    {
        $this->request = new Request;
        $this->url     = $url;
        $this->setPrefix();
    }

    /**
     * Método responsável por definir o prefixo das rotas
     *
     */
    private function setPrefix()
    {
        $parseUrl = parse_url($this->url);

        /* Define o prefixo */
        $this->prefix = $parseUrl['path'] ?? '';
    }

    /**
     * Método responsável por adicionar uma rota na classe
     *
     * @param string $method
     * @param string $route
     * @param array $params
     *
     */
    private function addRoute($method, $route, $params = [])
    {
        /* Validação dos parâmetros */
        foreach ($params as $key => $value) {
            if ($value instanceof Closure) {
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        /* Variáveis da Rota */
        $params['variables'] = [];

        /* Padrão de validação das variáveis */
        $patternVariable = '/{(.*?)}/';
        if (preg_match_all($patternVariable, $route, $matches)) {
            $route = preg_replace($patternVariable, '(.*?)', $route);
            $params['variables'] = $matches[1];
        }

        /* Padrão de validação da URL */
        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';

        /* Adiciona a rota dentro da classe */
        $this->routes[$patternRoute][$method] = $params;
    }

    /**
     * Método responsável por definir uma rota de GET
     *
     * @param string $route
     * @param array $params
     *
     */
    public function get($route, $params = [])
    {
        return $this->addRoute('GET', $route, $params);
    }

    /**
     * Método responsável por definir uma rota de POST
     *
     * @param string $route
     * @param array $params
     *
     */
    public function post($route, $params = [])
    {
        return $this->addRoute('POST', $route, $params);
    }

    /**
     * Método responsável por definir uma rota de PUT
     *
     * @param string $route
     * @param array $params
     *
     */
    public function put($route, $params = [])
    {
        return $this->addRoute('PUT', $route, $params);
    }

    /**
     * Método responsável por definir uma rota de DELETE
     *
     * @param string $route
     * @param array $params
     *
     */
    public function delete($route, $params = [])
    {
        return $this->addRoute('DELETE', $route, $params);
    }

    /**
     * Método resonsável por retornar a URI desconsiderando o prefixo
     *
     * @return string
     */
    private function getUri()
    {
        /* URI da Request */
        $uri = $this->request->getUri();

        /* Fatia a URI com o prefixo */
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

        /* Retorna a URI sem o prefixo */
        return end($xUri);
    }

    /**
     * Método responsável por retornar os dados da rota atual
     *
     * @return array
     */
    private function getRoute()
    {
        /* URI */
        $uri = $this->getUri();

        /* Método */
        $httpMethod = $this->request->getHttpMethod();

        /* Valida as Rotas */
        foreach ($this->routes as $patternRoute => $methods) {
            /* Verifica se a URI bate com o padrão */
            if (preg_match($patternRoute, $uri)) {
                /* Verifica o método */
                if (isset($methods[$httpMethod])) {
                    /* Retorno dos parâmetros da Rota */
                    return $methods[$httpMethod];
                }
                /* Método não permitido/definido */
                throw new Exception("Método não permitido.", 405);
            }
        }
        throw new Exception("URL não encontrada", 404);
    }

    /**
     * Método responsável por executar a rota atual
     *
     * @return Response
     */
    public function run()
    {
        try {
            /* throw new Exception("Página não encontrada", 404); */
            $route = $this->getRoute();

            /* Verifica o controlador */
            if (!isset($route['controller'])) {
                throw new Exception("A URL não pode ser processada.", 500);
            }

            /* Argumentos da função */
            $args = [];

            /* Retorna a execução da função */
            return call_user_func_array($route['controller'], $args);
        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }
}
