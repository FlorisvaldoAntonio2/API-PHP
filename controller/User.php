<?php

    require_once '../model/ConexaoApi.php';
    require_once '../model/ModelUser.php';


class User{
    private $conexao;
    private $user;

    public function __construct()
    {
        $this->conexao = new ConexaoApi();
        $this->user = new ModelUser();
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
        if(array_key_exists('nome',$value) && 
           array_key_exists('email',$value) && 
           array_key_exists('sexo',$value))
        {

            $this->user->setNome($value['nome']);
            $this->user->setEmail($value['email']);
            $this->user->setSexo($value['sexo']);
        
            return $this->user->persistir();
            
        }
        else{
            return ['cod'=> 417,'msg' =>'Parametro invalido ou faltando'];
        }
    }
}