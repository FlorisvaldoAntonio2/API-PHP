<?php

namespace api\controller;

class Uri{
    private $servico;
    private $metodo;
    public $resultado;
    public $http_status_code;
    public $valor;

    public function __construct(array $url)
    {   
        // define os atributos da class
        $this->url = $url;
        $this->servico = "api\controller\\" . $url[2];
        $this->metodo = strtolower($_SERVER['REQUEST_METHOD']);
        // De acordo com o VERBO HTTP define o atributo valor
        if($this->metodo === 'get' || $this->metodo === 'delete' || $this->metodo === 'put'){
            $this->valor[0] = isset($this->url[3]) ? $this->url[3] : null;
            $this->valor[1] = isset($this->url[4]) ? $this->url[4] : null;
        }
        elseif($this->metodo === 'post'){
            $this->valor[0] = isset($_POST) ? $_POST : null;
        }


    }

    public function run():void
    {
        // com a função call_user_func(), instanciamos a class, chamamos o metodo passando o valor
        // definido nos atributos
        $resp = call_user_func(array(new $this->servico, $this->metodo),$this->valor);
        // varifica a existencia da chave cod no array de resposta
        // caso negativo o padrão e 200(sucesso)
        $this->http_status_code = isset($resp['cod']) ? $resp['cod'] : 200;
        // transforma em JSON para melhor utilização
        $this->resultado = json_encode($resp,JSON_UNESCAPED_UNICODE);
    }



}