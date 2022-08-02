<?php

    class Genero {

        private $id_gen;
        private $nom_gen;

        public function __construct($id_gen,$nom_gen){
            $this->id_gen = $id_gen;
            $this->nom_gen = $nom_gen;
        }

        public function setid_gen($id_gen){
            $this->id_gen = $id_gen;
        }

        public function getid_gen(){
            return $this->id_gen;
        }

        public function setnom_gen($nom_gen){
            $this->nom_gen = $nom_gen;
        }

        public function getnom_gen(){
            return $this->nom_gen;
        }

    }

?>