<?php

    class Modelo {

        private $id_mod;
        private $nom_mod;

        public function __construct($id_mod,$nom_mod){
            $this->id_mod = $id_mod;
            $this->nom_mod = $nom_mod;
        }

        public function setid_mod($id_mod){
            $this->id_mod = $id_mod;
        }

        public function getid_mod(){
            return $this->id_mod;
        }

        public function setnom_mod($nom_mod){
            $this->nom_mod = $nom_mod;
        }

        public function getnom_mod(){
            return $this->nom_mod;
        }

    }

?>