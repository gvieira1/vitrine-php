<?php
    require_once "dadosproduto.php";
    class Passingproduto extends DadosProduto{
            
        public function setNomeProd($no){
            $this->nomeproduto=$no;
          }
    
        public function setPreco($pre){
            $this->preco=$pre;
          }

        public function setCategoria($cat){
            $this->categoria=$cat;
          }

          public function getNomeProd(){
            return $this->nomeproduto;
          }

          public function getPreco(){
            return $this->preco;
          }

          public function getCategoria(){
            return $this->categoria;
          }  

          public function setAutor($aut){
            $this->autor=$aut;
          }

          public function getAutor(){
            return $this->autor;
          }
    }

  
?>