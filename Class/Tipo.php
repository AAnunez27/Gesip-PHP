<?php

    class Tipo {

        private $id_tip;
        private $nom_tip;

        public function __construct($id_tip,$nom_tip){
            $this->id_tip = $id_tip;
            $this->nom_tip = $nom_tip;
        }

        public function setid_tip($id_tip){
            $this->id_tip = $id_tip;
        }

        public function getid_tip(){
            return $this->id_tip;
        }

        public function setnom_tip($nom_tip){
            $this->nom_tip = $nom_tip;
        }

        public function getnom_tip(){
            return $this->nom_tip;
        }

    }

?>