<?php

namespace api\model;

use api\model\Banco;

class ModelLivro extends Banco{
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

    //  Passa para o metoddo insert os dados de parametros e a class
     public function persistir(ARRAY $params,STRING $class)
     {
        $values = [$this->getTitulo(),$this->getAutor(),$this->getNum_pag()];
        return $this->insert($values,$params,$class);
     }

     //  Passa para o metoddo update os dados de parametros e a class e ID
     public function atualizar(ARRAY $id,ARRAY $params,STRING $class)
     {
         $values = [$this->getTitulo(),$this->getAutor(),$this->getNum_pag()];
         return $this->update($values,$id,$params,$class);
     }
}