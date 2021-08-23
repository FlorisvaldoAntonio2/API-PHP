<?php

namespace api\model;

use api\model\BancoEmprestimo;

class ModelEmprestimo extends BancoEmprestimo{
     private $cod_user;
     private $cod_livro;
     private $data_entrega;

     public function getUser():string
     {
         return $this->cod_user;
     }

     public function getLivro():string
     {
         return $this->cod_livro;
     }

     public function getDataEntrega():string
     {
         return $this->data_entrega;
     }

     public function setUser($value):void
     {
        //  implementar a validação titulo
        $this->cod_user = $value;

     }

     public function setLivro($value):void
     {
        //  implementar a validação autor
        $this->cod_livro = $value;

     }

     public function setDataEntrega($value):void
     {
        //  implementar a validação num_pag
        $this->data_entrega = $value;

     }

     public function persistir()
     {
         return $this->insert($this->getUser(),$this->getLivro(),$this->getDataEntrega());
     }

     public function atualizar($user,$livro)
     {
         return $this->update($this->getDataEntrega(),$user,$livro);
     }
}