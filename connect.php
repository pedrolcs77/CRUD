<?php

// 1. Carrega o carregador automático do Composer para reconhecer o Dotenv
require_once __DIR__ . "/vendor/autoload.php";

// 2. Inicia o carregamento das variáveis do arquivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * Classe responsável por criar e fornecer
 * uma conexão segura com o banco de dados via variáveis de ambiente.
 */
class Connect
{
    /**
     * Retorna uma única instância de conexão com o banco.
     * Agora os dados são obtidos via $_ENV para maior segurança.
     *
     * @return PDO
     */
    public static function getInstance(): PDO
    {
        static $instance = null;

        if ($instance === null) {
            try {
                // Buscamos as informações do nosso arquivo .env
                $host = $_ENV['DB_HOST'];
                $port = $_ENV['DB_PORT'] ?? '3307'; // Usa 3307 como padrão se não estiver no .env
                $dbname = $_ENV['DB_NAME'];
                $user = $_ENV['DB_USER'];
                $pass = $_ENV['DB_PASS'];

                // Montamos o DSN dinamicamente
                $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";

                $instance = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);

            } catch (PDOException $e) {
                // Em produção, você pode logar isso em vez de dar um die
                die("Erro de conexão com o banco de dados: " . $e->getMessage());
            }
        }

        return $instance;
    }
}