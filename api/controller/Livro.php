<?php

namespace api\controller;

use api\model\ModelLivro;
use api\controller\MetodosHTTP;

class Livro extends MetodosHTTP{
    protected $conexao;
    // parametros utilizados no insert e update
    public $parametros = ['titulo','autor','num_pag'];

    public function __construct()
    {
        $this->conexao = new ModelLivro();
    }

}