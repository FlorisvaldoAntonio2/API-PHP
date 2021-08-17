<?php

require_once "ConexaoApi.php";


class BancoLivro{
    protected $conn;
    private $erro;

    public function __construct()
    {
        
      $this->conn = ConexaoApi::getConection();


    }

    public function select(INT $id):array
    {
        $stmt = $this->conn->prepare("SELECT * FROM livro WHERE id = :ID");
        $stmt->bindValue(':ID',$id);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return ['cod' => 400, 'msg' => 'Livro não encontrado!'];
            
        }
        
    }

    public function delete(INT $id):array
    {
        $stmt = $this->conn->prepare("DELETE FROM livro WHERE id = :ID");
        $stmt->bindValue(':ID',$id);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return ['cod' => 200,'msg' => 'OK'];
        }
        else{
            return ['cod' => 400, 'msg' => 'Livro não encontrado!'];
            
        }
        
    }

    public function selectAll():array
    {
        $stmt = $this->conn->prepare("SELECT * FROM livro");
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return ['cod' => 400, 'msg' => 'Livro não encontrado!'];
            
        }
    }

    public function insert(STRING $titulo,STRING $autor, STRING $num_pag)
    {
        $stmt = $this->conn->prepare("INSERT INTO livro (id,titulo,autor,num_pag) VALUES (null, :TITULO, :AUTOR, :NUM_PAG)");
        $stmt->bindValue(':TITULO',$titulo);
        $stmt->bindValue(':AUTOR',$autor);
        $stmt->bindValue(':NUM_PAG',$num_pag);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return ['cod' => 200,'msg' => 'OK'];
        }
        else{
            return ['cod' => 500, 'msg' => 'ERRO ao inserir!'];
            
        }
    }

    public function update(STRING $titulo,STRING $autor, STRING $num_pag,INT $id):array
    {   

        $stmt = $this->conn->prepare("UPDATE livro SET titulo = :TITULO ,autor = :AUTOR,num_pag = :NUM WHERE id = :ID");
        $stmt->bindValue(':ID',$id);
        $stmt->bindValue(':TITULO',$titulo);
        $stmt->bindValue(':AUTOR',$autor);
        $stmt->bindValue(':NUM',$num_pag);

        $stmt->execute();
        if($stmt->rowCount() == 1){
            return ['cod' => 200,'msg' => 'OK'];
        }
        else{
            return ['cod' => 400, 'msg' => 'Usuario não encontrado!'];
            
        }
        
    }
}