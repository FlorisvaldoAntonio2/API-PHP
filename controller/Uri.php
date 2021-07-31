<?php


class Uri{
    private $servico;
    private $metodo;
    public $resultado;
    public $http_status_code;

    public function __construct(array $url)
    {
        $this->url = $url;
        $this->servico = $url[2];
        $this->metodo = strtolower($_SERVER['REQUEST_METHOD']);

        if($this->metodo === 'get' || $this->metodo === 'delete'){
            $this->valor = isset($this->url[3]) ? $this->url[3] : null;
        }
        elseif($this->metodo === 'post'){
            $this->valor = isset($_POST) ? $_POST: null;
        }

    }

    public function run():void
    {
        $resp = call_user_func(array(new $this->servico, $this->metodo),$this->valor);

        $this->http_status_code = isset($resp['cod']) ? $resp['cod'] : 200;

        $this->resultado = json_encode($resp,JSON_UNESCAPED_UNICODE);
    }



}