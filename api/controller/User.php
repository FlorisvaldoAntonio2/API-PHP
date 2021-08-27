<?php

namespace api\controller;

use api\model\ModelUser;
use api\controller\MetodosHTTP;

class User extends MetodosHTTP{
    protected $conexao;
    // parametros utilizados no insert e update
    public $parametros = ['nome','email','sexo'];

    public function __construct()
    {
        $this->conexao = new ModelUser();
    }   

}