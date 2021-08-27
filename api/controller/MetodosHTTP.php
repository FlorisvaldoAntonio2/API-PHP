<?php

namespace api\controller;
// class base para a utilização dos verbos HTTP
abstract class MetodosHTTP{

    public function get($id = null)
    {   
        // verifica se existe o valor do ID
        if($id[0]){
            // passamos o ID e o nome da class que foi instancida dinâmicamente
            return $this->conexao->select((int)$id[0],get_class($this));
        }
        // caso não exista traz tudo
        else{
            return $this->conexao->selectAll(get_class($this));
        }
        
    }

    public function delete($id = null)
    {
        if($id[0]){
            //cast para INT
            return $this->conexao->delete((int)$id[0],get_class($this));
        }
        else{
            return ['cod'=> 417,'msg' =>'Parametro invalido ou faltando'];
        }
        
    }

    public function put($value = null)
    {
        $resu = [];
        parse_str(file_get_contents('php://input'), $resu);
    
        $parametros = $this->parametros;

        if(isset($resu) && $value != null){

            if(array_key_exists($parametros[0],$resu) && 
                array_key_exists($parametros[1],$resu) && 
                array_key_exists($parametros[2],$resu))
                {

                
                    for($cont = 0;$cont < 3;$cont++){
                        $nomeSet = 'set' . $parametros[$cont];
                        $this->conexao->$nomeSet($resu[$parametros[$cont]]);
                    }
                
                    return $this->conexao->atualizar((int)$value[0],$parametros,get_class($this));
            
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
        // atribui o valor do atributo parametros da class para nossa variavel local
        $parametros = $this->parametros;
        // verifica a existencia dos parametros necessarios em cada class
        if(array_key_exists($parametros[0],$value[0]) && 
           array_key_exists($parametros[1],$value[0]) && 
           array_key_exists($parametros[2],$value[0]))
        {
            // LOOP responsavel por chama os metodos SET de cada parametro
            for($cont = 0;$cont < 3;$cont++){
                $nomeSet = 'set' . $parametros[$cont];
                $this->conexao->$nomeSet($value[0][$parametros[$cont]]);
            }
            // passando os dados para o metodo persistir de sua classe(Definido no atributo conexão da class)
            return $this->conexao->persistir($parametros,get_class($this));
            
        }
        else{
            // em caso de erro retorna um array com o codigo de erro no lado do cliente
            return ['cod'=> 417,'msg' =>'Parametro invalido ou faltando'];
        }
    }



}