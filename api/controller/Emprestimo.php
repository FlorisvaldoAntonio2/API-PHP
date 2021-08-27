<?php
// ATENÇÃO AINDA NÃO REFATORADO
namespace api\controller;

use api\model\ModelEmprestimo;

class Emprestimo{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new ModelEmprestimo();
    }

    public function get($nome = null)
    {
        if($nome[0]){
            return $this->conexao->select((int)$nome[0],(int)$nome[1]);
        }
        else{
            return $this->conexao->selectAll();
        }
        
    }

    public function delete($values = null)
    {
        if($values[0] && $values[1]){
            return $this->conexao->delete((int)$values[0],(int)$values[1]);
        }
        else{
            return ['cod'=> 417,'msg' =>'Parametro invalido ou faltando'];
        }
        
    }

    public function put($values = null)
    {
        $resu = [];
        parse_str(file_get_contents('php://input'), $resu);
    
        if(isset($resu) && $values[0] != null && $values[1] != null){

            if(array_key_exists('data_entrega',$resu))
        {

                    $this->conexao->setDataEntrega($resu['data_entrega']);
                
                    return $this->conexao->atualizar((int)$values[0],(int)$values[1]);
            
                }
            else{
                return ['cod'=> 417,'msg' =>'Parametro invalido ou faltando'];
            }
        }
        else{
            return ['cod'=> 417,'msg' =>'Parametro invalido ou faltando'];
        }
        
    }

    public function post($value)
    {
        
        if(array_key_exists('cod_user',$value[0]) && 
           array_key_exists('cod_livro',$value[0]) && 
           array_key_exists('data_entrega',$value[0]))
        {
            
            $this->conexao->setUser($value[0]['cod_user']);
            $this->conexao->setLivro($value[0]['cod_livro']);
            $this->conexao->setDataEntrega($value[0]['data_entrega']);
        
            return $this->conexao->persistir();
            
        }
        else{
            return ['cod'=> 417,'msg' =>'Parametro invalido ou faltando'];
        }
    }
}