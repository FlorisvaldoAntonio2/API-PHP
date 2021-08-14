<?php

require_once 'BancoUser.php';
require_once "ConexaoApi.php";

class ModelUser extends BancoUser{
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

     public function persistir()
     {
         
         return $this->insert($this->getNome(),$this->getEmail(),$this->getSexo());
     }
}