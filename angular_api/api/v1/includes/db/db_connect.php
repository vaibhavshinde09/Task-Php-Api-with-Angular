<?php
    require_once 'db_config.php';

class DB_CONNECT {

    protected $con;
    private $server = "mysql:host=".DB_SERVER.";dbname=".DB_DATABASE."";
    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);

    function __construct() {
        $this->connect();
    }

    function __destruct() {
        
    }

    public function connect() {
        try {
            $this->con = new PDO($this->server,DB_USER,DB_PASSWORD, $this->options);
        } catch (PDOException $e) {
            return ["status"=>"false","message"=>"Cant connect to Database"];
        }
        return $this->con;
    }

    function close() {
        $this->con = null;
    }

}

?>