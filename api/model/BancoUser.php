<?php

namespace api\model;

use api\model\ConexaoApi;

class BancoUser{
    protected $conn;
    private $erro;

    public function __construct()
    {
      $this->conn = ConexaoApi::getConection();
    }

    public function select(INT $id):array
    {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE id = :ID");
        $stmt->bindValue(':ID',$id);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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

    public function update(STRING $nome,STRING $email, STRING $sexo,INT $id):array
    {   

        $stmt = $this->conn->prepare("UPDATE user SET nome = :NOME ,email = :EMAIL,sexo = :SEXO WHERE id = :ID");
        $stmt->bindValue(':ID',$id);
        $stmt->bindValue(':NOME',$nome);
        $stmt->bindValue(':EMAIL',$email);
        $stmt->bindValue(':SEXO',$sexo);

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
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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