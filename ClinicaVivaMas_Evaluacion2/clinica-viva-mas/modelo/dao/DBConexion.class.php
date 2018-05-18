<?php

class DBConexion extends PDO {
    private static $USER = "admin";
    private static $PASSWORD = "sa123";   
    private static $DSN='mysql:host=localhost;dbname=clinicavivamas;charset=utf8';    
    
    public function __construct() {
        parent::__construct(static::$DSN,
                            static::$USER,
                            static::$PASSWORD);
    }

    public static function getInstance() {
        return new DBConexion();        
    }

}
