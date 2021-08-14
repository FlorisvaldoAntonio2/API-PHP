<?php

    require_once '../model/ConexaoApi.php';
    require_once '../model/ModelLivro.php';


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
        if($id){
            return $this->conexao->select($id);
        }
        else{
            return $this->conexao->selectAll();
        }
        
    }

    public function delete($id = null)
    {
        if($id){
            return $this->conexao->delete($id);
        }
        else{
            return ['cod'=> 417,'msg' =>'Parametro invalido ou faltando'];
        }
        
    }

    public function post($value)
    {
        if(array_key_exists('titulo',$value) && 
           array_key_exists('autor',$value) && 
           array_key_exists('num_pag',$value))
        {

            $this->livro->setTitulo($value['titulo']);
            $this->livro->setAutor($value['autor']);
            $this->livro->setNum_pag($value['num_pag']);
        
            return $this->livro->persistir();
            
        }
        else{
            return ['cod'=> 417,'msg' =>'Parametro invalido ou faltando'];
        }
    }
}