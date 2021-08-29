<?php

namespace api\model;

use api\model\Banco;

class ModelUser extends Banco{
     private $nome;
     private $email;
     private $sexo;

     public function getNome():string
     {
         return $this->nome;
     }

     public function getEmail():string
     {
         return $this->email;
     }

     public function getSexo():string
     {
         return $this->sexo;
     }

     public function setNome($value):void
     {
        //  implementar a validação nome
        $this->nome = $value;

     }

     public function setEmail($value):void
     {
        //  implementar a validação email
        $this->email = $value;

     }

     public function setSexo($value):void
     {
        //  implementar a validação sexo
        $this->sexo = $value;

     }

     //  Passa para o metoddo insert os dados de parametros e a class
     public function persistir(ARRAY $params,STRING $class)
     {
        $values = [$this->getNome(),$this->getEmail(),$this->getSexo()];
        return $this->insert($values,$params,$class);
     }

     //  Passa para o metoddo insert os dados de parametros e a class e ID
     public function atualizar(ARRAY $id,ARRAY $params,STRING $class)
     {
         $values = [$this->getNome(),$this->getEmail(),$this->getSexo()];
         return $this->update($values,$id,$params,$class);
     }
}