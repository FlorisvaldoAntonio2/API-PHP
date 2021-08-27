<?php

namespace api\model;
// class respnsavel por criar a conexão com o banco de dados com o PDO
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