<?php

namespace App\Core;

class Enviroments
{
    /**
     * Método responsável por carregar as variáveis de ambiente do projeto
     *
     * @param string $dir [caminho absoluto onde encontra-se o arquivo .env]
     *
     */
    public static function load($dir)
    {
        /* verifica se o arquivo existe */
        if (!file_exists($dir . '/.env')) {
            return false;
        }

        $lines = file($dir . '/.env');
        foreach ($lines as $line) {
            if (getenv('OS') == 'Windows_NT') {
                /* S.O WINDOWS */
                putenv($line);
            } else {
                /* S.O LINUX */
                putenv(trim($line));
            }
        }
    }
}
