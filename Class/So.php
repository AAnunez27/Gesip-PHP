<?php

    class So {

        private $id_so;
        private $nom_so;

        public function __construct($id_so,$nom_so){
            $this->id_so = $id_so;
            $this->nom_so = $nom_so;
        }

        public function setid_so($id_so){
            $this->id_so = $id_so;
        }

        public function getid_so(){
            return $this->id_so;
        }

        public function setnom_so($nom_so){
            $this->nom_so = $nom_so;
        }

        public function getnom_so(){
            return $this->nom_so;
        }

    }

?>