<?php

require_once 'ConexaoApi.php';
require_once 'BancoLivro.php';

class ModelLivro extends BancoLivro{
     private $titulo;
     private $autor;
     private $num_pag;

     public function getTitulo():string
     {
         return $this->titulo;
     }

     public function getAutor():string
     {
         return $this->autor;
     }

     public function getNum_pag():string
     {
         return $this->num_pag;
     }

     public function setTitulo($value):void
     {
        //  implementar a validação titulo
        $this->titulo = $value;

     }

     public function setAutor($value):void
     {
        //  implementar a validação autor
        $this->autor = $value;

     }

     public function setNum_pag($value):void
     {
        //  implementar a validação num_pag
        $this->num_pag = $value;

     }

     public function persistir()
     {
         return $this->insert($this->getTitulo(),$this->getAutor(),$this->getNum_pag());
     }

     public function atualizar($id)
     {
         return $this->update($this->getTitulo(),$this->getAutor(),$this->getNum_pag(),$id);
     }
}