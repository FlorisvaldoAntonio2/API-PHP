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

    public function select(ARRAY $id ,String $class):array
    {
        // chamamos o metodo privado nomeClass para termos apenas o nome da class
        // OBS: o nome da nossas class são os mesmo de nossas tabelas no BANCO DE DADOS
        // assim podemos ter apenas um metodo select por exemplo
        // atendendo as requisições de user , livro ...
        $classe = $this->nomeClasse($class);

        $where = $this->definicaoWhere($id);
        
        $stmt = $this->conn->prepare("SELECT * FROM $classe $where");
        
        $stmt->bindValue(':ID',$id[0]);

        // se for emprestimo libera o bindValue
        if(isset($id[1])){
            $stmt->bindValue(':ID2',$id[1]);
        }

        $stmt->execute();
        if($stmt->rowCount() == 1){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            return ['cod' => 400, 'msg' => 'Não encontrado!'];
            
        }
        
    }

    public function delete(ARRAY $id, String $class):array
    {
        // chamamos o metodo privado nomeClass para termos apenas o nome da class
        // OBS: o nome da nossas class são os mesmo de nossas tabelas no BANCO DE DADOS
        // assim podemos ter apenas um metodo select por exemplo
        // atendendo as requisições de user , livro ...
        $classe = $this->nomeClasse($class);

        $where = $this->definicaoWhere($id);

        $stmt = $this->conn->prepare("DELETE FROM $classe $where");
        $stmt->bindValue(':ID',$id[0]);
        if(isset($id[1])){
            $stmt->bindValue(':ID2',$id[1]);
        }
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return ['cod' => 200,'msg' => 'OK'];
        }
        else{
            return ['cod' => 400, 'msg' => 'Não encontrado!'];
            
        }
        
    }
    // realiza o UPDATE de dados na tabela definida pela class
    public function update(ARRAY $values,ARRAY $id ,ARRAY $params,STRING $class ):array
    {   
        $classe = $this->nomeClasse($class);

        $where = $this->definicaoWhere($id);
        // os params são de acordo com os definidos na class
        $stmt = $this->conn->prepare("UPDATE $classe SET $params[0] = :VALOR1 ,$params[1] = :VALOR2,$params[2] = :VALOR3 $where");
        $stmt->bindValue(':ID',$id[0]);
        $stmt->bindValue(':VALOR1',$values[0]);
        $stmt->bindValue(':VALOR2',$values[1]);
        $stmt->bindValue(':VALOR3',$values[2]);
        if($id[1] != null){
            $stmt->bindValue(':ID2',$id[1]);
        }

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
    public function insert(ARRAY $values,$params,$class)
    {
        $classe = $this->nomeClasse($class);
        // os params são de acordo com os definidos na class
        if($classe != "emprestimo"){
            $stmt = $this->conn->prepare("INSERT INTO $classe (id,$params[0],$params[1],$params[2]) VALUES (null, :VALOR1, :VALOR2, :VALOR3)");
        }
        else{
            $stmt = $this->conn->prepare("INSERT INTO $classe ($params[0],$params[1],$params[2]) VALUES (:VALOR1, :VALOR2, :VALOR3)");
        }
        $stmt->bindValue(':VALOR1',$values[0]);
        $stmt->bindValue(':VALOR2',$values[1]);
        $stmt->bindValue(':VALOR3',$values[2]);
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

    private function definicaoWhere(ARRAY $id):STRING
    {
        if(!isset($id[1])){
            return "WHERE id = :ID";
        }
        else{
            return "WHERE cod_user = :ID AND cod_livro = :ID2";
        }
    }
}