<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// die;
require_once $_SERVER["DOCUMENT_ROOT"] . "/yavnik/_code/blog_managment_system/config/const.php";

class DB
{
    private static $instance = null;
    private $PDO;
    private function __construct($DB_HOST = DB_HOST, $DB_NAME = DB_NAME, $USER = USER, $PASS = PASS, $driver_option = array(PDO::ATTR_PERSISTENT => false))
    {
        try {
            $this->PDO = new PDO(
                "mysql:host=$DB_HOST;dbname=$DB_NAME",
                $USER,
                $PASS,
                $driver_option
            );
            $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("PDO CONNECTION ERROR:-" . $e->getMessage() . "<br>");
        }
    }
    static function get_instance()
    {
        if (self::$instance === null) {
            self::$instance = new self($DB_HOST = DB_HOST, $DB_NAME = DB_NAME, $USER = USER, $PASS = PASS, $driver_option = array(PDO::ATTR_PERSISTENT => false));
        }
        return self::$instance;
    }
    function get_connection()
    {
        return $this->PDO;
    }
}
