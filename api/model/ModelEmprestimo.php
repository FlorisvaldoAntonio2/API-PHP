<?php

namespace api\model;

use api\model\Banco;

class ModelEmprestimo extends Banco{
     private $cod_user;
     private $cod_livro;
     private $data_entrega;

     public function getCod_user():string
     {
         return $this->cod_user;
     }

     public function getCod_livro():string
     {
         return $this->cod_livro;
     }

     public function getData_entrega():string
     {
         return $this->data_entrega;
     }

     public function setCod_user($value):void
     {
        //  implementar a validação titulo
        $this->cod_user = $value;

     }

     public function setCod_livro($value):void
     {
        //  implementar a validação autor
        $this->cod_livro = $value;

     }

     public function setData_entrega($value):void
     {
        //  implementar a validação num_pag
        $this->data_entrega = $value;

     }

     public function persistir(ARRAY $params,STRING $class)
     {
        $values = [$this->getCod_user(),$this->getCod_livro(),$this->getData_entrega()];
        return $this->insert($values,$params,$class);
     }

     public function atualizar(ARRAY $id,ARRAY $params,STRING $class)
     {
        $values = [$this->getCod_user(),$this->getCod_livro(),$this->getData_entrega()];
        return $this->update($values,$id,$params,$class);
     }
}