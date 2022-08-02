<?php

    class Marca {

        private $id_mar;
        private $nom_mar;

        public function __construct($id_mar,$nom_mar){
            $this->id_mar = $id_mar;
            $this->nom_mar = $nom_mar;
        }

        public function setid_mar($id_mar){
            $this->id_mar = $id_mar;
        }

        public function getid_mar(){
            return $this->id_mar;
        }

        public function setnom_mar($nom_mar){
            $this->nom_mar = $nom_mar;
        }

        public function getnom_mar(){
            return $this->nom_mar;
        }

    }

?>