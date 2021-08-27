<?php

namespace api\model;

use api\model\ConexaoApi;

class Banco{
    protected $conn;
    private $erro;

    public function __construct()
    {
        // cria uma referência com a class de conexão
      $this->conn = ConexaoApi::getConection();
    }

    public function select(INT $id,String $class):array
    {
        // chamamos o metodo privado nomeClass para termos apenas o nome da class
        // OBS: o nome da nossas class são os mesmo de nossas tabelas no BANCO DE DADOS
        // assim podemos ter apenas um metodo select por exemplo
        // atendendo as requisições de user , livro ...
        $classe = $this->nomeClasse($class);
        
        $stmt = $this->conn->prepare("SELECT * FROM $classe WHERE id = :ID");
        
        $stmt->bindValue(':ID',$id);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            return ['cod' => 400, 'msg' => 'Não encontrado!'];
            
        }
        
    }

    public function delete(INT $id, String $class):array
    {
        // chamamos o metodo privado nomeClass para termos apenas o nome da class
        // OBS: o nome da nossas class são os mesmo de nossas tabelas no BANCO DE DADOS
        // assim podemos ter apenas um metodo select por exemplo
        // atendendo as requisições de user , livro ...
        $classe = $this->nomeClasse($class);
        $stmt = $this->conn->prepare("DELETE FROM $classe WHERE id = :ID");
        $stmt->bindValue(':ID',$id);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return ['cod' => 200,'msg' => 'OK'];
        }
        else{
            return ['cod' => 400, 'msg' => 'Não encontrado!'];
            
        }
        
    }
    // realiza o UPDATE de dados na tabela definida pela class
    public function update(STRING $v1,STRING $v2, STRING $v3,INT $id ,ARRAY $params,STRING $class ):array
    {   
        $classe = $this->nomeClasse($class);
        // os params são de acordo com os definidos na class
        $stmt = $this->conn->prepare("UPDATE $classe SET $params[0] = :VALOR1 ,$params[1] = :VALOR2,$params[2] = :VALOR3 WHERE id = :ID");
        $stmt->bindValue(':ID',$id);
        $stmt->bindValue(':VALOR1',$v1);
        $stmt->bindValue(':VALOR2',$v2);
        $stmt->bindValue(':VALOR3',$v3);

        $stmt->execute();
        if($stmt->rowCount() == 1){
            return ['cod' => 200,'msg' => 'OK'];
        }
        else{
            return ['cod' => 400, 'msg' => 'Não encontrado!'];
            
        }
        
    }

    public function selectAll(STRING $class):array
    {
        // chamamos o metodo privado nomeClass para termos apenas o nome da class
        // OBS: o nome da nossas class são os mesmo de nossas tabelas no BANCO DE DADOS
        // assim podemos ter apenas um metodo select por exemplo
        // atendendo as requisições de user , livro ...
        $classe = $this->nomeClasse($class);
        $stmt = $this->conn->prepare("SELECT * FROM $classe");
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            return ['cod' => 400, 'msg' => 'Não encontrado!'];
            
        }
    }
    // realiza o INSERT de dados na tabela definida pela class
    public function insert(STRING $v1,STRING $v2, STRING $v3,$params,$class)
    {
        $classe = $this->nomeClasse($class);
        // os params são de acordo com os definidos na class
        $stmt = $this->conn->prepare("INSERT INTO $classe (id,$params[0],$params[1],$params[2]) VALUES (null, :VALOR1, :VALOR2, :VALOR3)");
        $stmt->bindValue(':VALOR1',$v1);
        $stmt->bindValue(':VALOR2',$v2);
        $stmt->bindValue(':VALOR3',$v3);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return ['cod' => 200,'msg' => 'OK'];
        }
        else{
            return ['cod' => 500, 'msg' => 'ERRO ao inserir!'];
            
        }
    }
    // metodo responsavel por retirar o namespace das class
    // assim deixando pronto e identico ao nomes das tabelas
    private function nomeClasse(STRING $nomeCompleto):string
    {
        $nome = explode('\\',$nomeCompleto);
        return strtolower($nome[2]);
    }
}