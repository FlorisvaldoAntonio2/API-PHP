<?php

namespace api\controller;

use api\model\BancoUser;
use api\model\ModelUser;
use api\controller\InterfaceMetodos;

class User implements InterfaceMetodos{
    private $conexao;
    private $user;

    public function __construct()
    {
        $this->conexao = new BancoUser();
        $this->user = new ModelUser();
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
            //cast para INT
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

            if(array_key_exists('nome',$resu) && 
                array_key_exists('email',$resu) && 
                array_key_exists('sexo',$resu))
                {

                    $this->user->setNome($resu['nome']);
                    $this->user->setEmail($resu['email']);
                    $this->user->setSexo($resu['sexo']);
                
                    return $this->user->atualizar((int)$value[0]);
            
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
    
        if(array_key_exists('nome',$value[0]) && 
           array_key_exists('email',$value[0]) && 
           array_key_exists('sexo',$value[0]))
        {

            $this->user->setNome($value[0]['nome']);
            $this->user->setEmail($value[0]['email']);
            $this->user->setSexo($value[0]['sexo']);
        
            return $this->user->persistir();
            
        }
        else{
            return ['cod'=> 417,'msg' =>'Parametro invalido ou faltando'];
        }
    }
}