<?php

require __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

abstract class Db
{
    private static $host;

    private static $port;

    private static $db_name;

    private static $username;

    private static $password;

    private static $dsn;

    private static function init()
    {
        self::$host = $_ENV['DB_HOSTNAME'];
        self::$port = $_ENV['PORT'];
        self::$db_name = $_ENV['DB_NAME'];
        self::$username = $_ENV['DB_USERNAME'];
        self::$password = $_ENV['DB_PASSWORD'];
        self::$dsn = 'mysql:host='.self::$host.';port='.self::$port.';dbname='.self::$db_name.';charset=utf8mb4';
    }

    public static function connect()
    {
        self::init();

        try {
            $pdo = new PDO(self::$dsn, self::$username, self::$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            addToErrLog('Database Connection Failed', $e->getMessage());
        }

        return $pdo;
    }

    public static function query(string $sql, $values = [])
    {
        try {
            $pdo = self::connect();
            $query = $pdo->prepare($sql);
            $query->execute($values);

            $query = null;
            $pdo = null;
            echo 'Query has been successfully executed.';
        } catch (PDOException $e) {
            addToErrLog('Database Query Failed', $e->getMessage());
        }
    }

    public static function select(string $sql, $values = [])
    {

        try {
            $pdo = self::connect();
            $query = $pdo->prepare($sql);
            $query->execute($values);
            $data = $query->fetchAll();

            $query = null;
            $pdo = null;

            return $data;
        } catch (PDOException $e) {
            addToErrLog('Database Select Execution Failed', $e->getMessage());
        }

    }

    public static function selectOne(string $sql, $values = [])
    {
        try {
            $pdo = self::connect();
            $query = $pdo->prepare($sql);
            $query->execute($values);
            $data = $query->fetch();

            $query = null;
            $pdo = null;

            return $data;
        } catch (PDOException $e) {
            addToErrLog('Database Select One Execution Failed', $e->getMessage());
        }
    }
}
