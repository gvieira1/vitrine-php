<?php 
    require_once "dadousuario.php";
    class Passing extends DadoUsuario{

           public function setNome($nm){
             $this->nome=$nm;
           }

           public function setEmail($em){
            $this->email=$em;
          }

           public function setTelefone($tl){
            $this->telefone=$tl;
           }

           public function setUsuario($us){
            $this->usuario=$us;
          }

          public function setSenha($senha){
            $this->senha = password_hash($senha, PASSWORD_BCRYPT);
          }

          public function setNascimento($na){
            $this->nascimento=$na;
          }

          public function setId($id){
            $this->id=$id;
          }

          public function setTipo($ti){
            $this->tipo=$ti;
          }

           

           public function getNome(){
             return $this->nome;
           }

           public function getEmail(){
            return $this->email;
           }

           public function getTelefone(){
            return $this->telefone;
           }

           public function getUsuario(){
            return $this->usuario;
          }

          public function getSenha(){
            return $this->senha;
          }

          public function getNascimento(){
            return $this->nascimento;
          }

          public function getId(){
            return $this->id;
          }

          public function getTipo(){
            return $this->tipo;
          }

    }

?>