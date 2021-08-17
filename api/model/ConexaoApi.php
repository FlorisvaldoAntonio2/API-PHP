<?php

namespace api\model;

class ConexaoApi {
    public static $conn;
    private static $erro;

    public static function getConection(){

            try{
                self::$conn = new \PDO("mysql:host=" . HOST . ";dbname=" . DB, USER , PASS);
                
            }
            
            catch(\PDOException $e){
                self::$erro = $e->getMessage();
            }
            
        
        return self::$conn;
    }
}