<?php


class DB
{

    /**
     * @var PDO
     */
    static private $db;

    /**
     * @var null
     */
    protected static $instance = null;

    /**
     * DB constructor.
     * @throws Exception
     */
    public function __construct()
    {
        if (self::$instance === null) {
            try {
                self::$db = new PDO(
                    Config::DB_TYPE . ':dbname=' . Config::DB_NAME . ';host=' . Config::DB_HOST . '',
                    Config::DB_LOGIN,
                    Config::DB_PASSWORD
                );
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$instance;
    }

    /**
     * @param $q
     * @return bool|PDOStatement
     */
    public static function prepare($q)
    {
        return self::$db->prepare($q);
    }

    /**
     * @param $q
     * @return mixed
     */
    public static function execute($q)
    {
        return self::$db->execute($q);
    }

    /**
     * @return string
     */
    public static function lastInsertId()
    {
        return self::$db->lastInsertId();
    }

    /**
     * @param $q
     * @return mixed
     */
    public static function fetch($q)
    {
        return self::$db->fetch($q);
    }
}