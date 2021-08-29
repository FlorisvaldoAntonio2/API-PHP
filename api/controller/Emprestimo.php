<?php
// ATENÇÃO AINDA NÃO REFATORADO
namespace api\controller;

use api\model\ModelEmprestimo;
use api\controller\MetodosHTTP;

class Emprestimo extends MetodosHTTP{
    protected $conexao;

    protected $parametros = ["cod_user","cod_livro","data_entrega"];

    public function __construct()
    {
        $this->conexao = new ModelEmprestimo();
    }

}