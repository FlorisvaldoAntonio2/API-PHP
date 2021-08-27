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
         return $this->insert($this->getTitulo(),$this->getAutor(),$this->getNum_pag(),$params,$class);
     }

     //  Passa para o metoddo update os dados de parametros e a class e ID
     public function atualizar(INT $id,ARRAY $params,STRING $class)
     {
         return $this->update($this->getTitulo(),$this->getAutor(),$this->getNum_pag(),$id,$params,$class);
     }
}