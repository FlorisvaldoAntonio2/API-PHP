<?php

namespace api\controller;

use api\model\ModelLivro;
use api\model\BancoLivro;

class Livro{
    private $conexao;
    private $livro;

    public function __construct()
    {
        $this->conexao = new BancoLivro();
        $this->livro = new ModelLivro();
    }

    public function get($id = null)
    {
        if($id[0]){
            return $this->conexao->select((int)$id[0]);
        }
        else{
            return $this->conexao->selectAll();
        }
        
    }

    public function delete($id = null)
    {
        if($id[0]){
            return $this->conexao->delete((int)$id[0]);
        }
        else{
            return ['cod'=> 417,'msg' =>'Parametro invalido ou faltando'];
        }
        
    }

    public function put($value = null)
    {
        $resu = [];
        parse_str(file_get_contents('php://input'), $resu);
    
        if(isset($resu) && $value != null){

            if(array_key_exists('titulo',$resu) && 
                array_key_exists('autor',$resu) && 
                array_key_exists('num_pag',$resu))
                {

                    $this->livro->setTitulo($resu['titulo']);
                    $this->livro->setAutor($resu['autor']);
                    $this->livro->setNum_pag($resu['num_pag']);
                
                    return $this->livro->atualizar((int)$value[0]);
            
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
        
        if(array_key_exists('titulo',$value[0]) && 
           array_key_exists('autor',$value[0]) && 
           array_key_exists('num_pag',$value[0]))
        {
            
            $this->livro->setTitulo($value[0]['titulo']);
            $this->livro->setAutor($value[0]['autor']);
            $this->livro->setNum_pag($value[0]['num_pag']);
        
            return $this->livro->persistir();
            
        }
        else{
            return ['cod'=> 417,'msg' =>'Parametro invalido ou faltando'];
        }
    }
}