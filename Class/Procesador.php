<?php

    class Procesador {

        private $id_pro;
        private $nom_pro;

        public function __construct($id_pro,$nom_pro){
            $this->id_pro = $id_pro;
            $this->nom_pro = $nom_pro;
        }

        public function setid_pro($id_pro){
            $this->id_pro = $id_pro;
        }

        public function getid_pro(){
            return $this->id_pro;
        }

        public function setnom_pro($nom_pro){
            $this->nom_pro = $nom_pro;
        }

        public function getnom_pro(){
            return $this->nom_pro;
        }

    }

?>