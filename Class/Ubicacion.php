<?php

    class Ubicacion {

        private $id_ubi;
        private $nom_ubi;

        public function __construct($id_ubi,$nom_ubi){
            $this->id_ubi = $id_ubi;
            $this->nom_ubi = $nom_ubi;
        }

        public function setid_ubi($id_ubi){
            $this->id_ubi = $id_ubi;
        }

        public function getid_ubi(){
            return $this->id_ubi;
        }

        public function setnom_ubi($nom_ubi){
            $this->nom_ubi = $nom_ubi;
        }

        public function getnom_ubi(){
            return $this->nom_ubi;
        }

    }

?>