<?php
// ATENÇÃO AINDA NÃO REFATORADO
namespace api\model;

use api\model\ConexaoApi;

class BancoEmprestimo{
    protected $conn;
    private $erro;

    public function __construct()
    {
      $this->conn = ConexaoApi::getConection();
    }

    public function select(INT $user , INT $livro = null):array
    {   
        if(!$livro == null){
            $where = " WHERE cod_user = :COD_U AND cod_livro = :COD_L";
        }
        else{
            $where = " WHERE cod_user = :COD_U";
        }

        $stmt = $this->conn->prepare("SELECT * FROM emprestimo $where");
        $stmt->bindValue(':COD_U',$user);
        if(!$livro == null){
            $stmt->bindValue(':COD_L',$livro);
        }
        
        $stmt->execute();

        if($stmt->rowCount() > 0){
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            return ['cod' => 400, 'msg' => 'Emprestimo não encontrado!'];
            
        }
        
    }

    public function delete(INT $user,INT $livro):array
    {
        $stmt = $this->conn->prepare("DELETE FROM emprestimo WHERE cod_user = :COD_U AND cod_livro = :COD_L");
        $stmt->bindValue(':COD_U',$user);
        $stmt->bindValue(':COD_L',$livro);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return ['cod' => 200,'msg' => 'OK'];
        }
        else{
            return ['cod' => 400, 'msg' => 'Emprestimo não encontrado!'];
            
        }
        
    }

    public function update(STRING $data_entrega,INT $user, INT $livro):array
    {   
        $stmt = $this->conn->prepare("UPDATE emprestimo SET data_entrega = :DATA_E WHERE cod_user = :COD_U AND cod_livro = :COD_L");
        $stmt->bindValue(':DATA_E',$data_entrega);
        $stmt->bindValue(':COD_U',$user);
        $stmt->bindValue(':COD_L',$livro);
        $stmt->execute();   

        if($stmt->rowCount() > 0){
            return ['cod' => 200,'msg' => 'OK'];
        }
        else{
            return ['cod' => 400, 'msg' => 'Emprestimo não encontrado!'];
            
        }
        
    }

    public function selectAll():array
    {
        $stmt = $this->conn->prepare("SELECT * FROM emprestimo");
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        else{
            return ['cod' => 400, 'msg' => 'Emprestimo não encontrado!'];
            
        }
    }

    public function insert(INT $cod_user,INT $cod_livro, STRING $data_entrega)
    {
        $stmt = $this->conn->prepare("INSERT INTO emprestimo (cod_user,cod_livro,data_entrega) VALUES (:COD_U, :COD_L, :DATA_E)");
        $stmt->bindValue(':COD_U',$cod_user);
        $stmt->bindValue(':COD_L',$cod_livro);
        $stmt->bindValue(':DATA_E',$data_entrega);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return ['cod' => 200,'msg' => 'OK'];
        }
        else{
            return ['cod' => 500, 'msg' => 'ERRO ao inserir!'];
            
        }
    }
}