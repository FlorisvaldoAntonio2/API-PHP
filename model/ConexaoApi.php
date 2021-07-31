<?php

require_once '../config/config.php';

class ConexaoApi {
    protected $conn;
    private $erro;

    public function __construct()
    {
        
        if($this->conn == null || empty($this->conn)){

            try{
                $this->conn = new PDO("mysql:host=" . HOST . ";dbname=" . DB, USER , PASS);
            }
            catch(PDOException $e){
                $this->erro = $e->getMessage();
            }
            
        }

    }

    public function select(INT $id):array
    {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE id = :ID");
        $stmt->bindValue(':ID',$id);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return ['cod' => 400, 'msg' => 'Usuario não encontrado!'];
            
        }
        
    }

    public function delete(INT $id):array
    {
        $stmt = $this->conn->prepare("DELETE FROM user WHERE id = :ID");
        $stmt->bindValue(':ID',$id);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return ['cod' => 200,'msg' => 'OK'];
        }
        else{
            return ['cod' => 400, 'msg' => 'Usuario não encontrado!'];
            
        }
        
    }

    public function selectAll():array
    {
        $stmt = $this->conn->prepare("SELECT * FROM user");
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return ['cod' => 400, 'msg' => 'Usuario não encontrado!'];
            
        }
    }

    public function insert(STRING $nome,STRING $email, STRING $sexo)
    {
        $stmt = $this->conn->prepare("INSERT INTO user (id,nome,email,sexo) VALUES (null, :NOME, :EMAIL, :SEXO)");
        $stmt->bindValue(':NOME',$nome);
        $stmt->bindValue(':EMAIL',$email);
        $stmt->bindValue(':SEXO',$sexo);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return ['cod' => 200,'msg' => 'OK'];
        }
        else{
            return ['cod' => 500, 'msg' => 'ERRO ao inserir!'];
            
        }
    }
}