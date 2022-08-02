<?php

    class Estado {

        private $id_est;
        private $nom_Est;

        public function __construct($id_est,$nom_Est){
            $this->id_est = $id_est;
            $this->nom_Est = $nom_Est;
        }

        public function setid_est($id_est){
            $this->id_est = $id_est;
        }

        public function getid_est(){
            return $this->id_est;
        }

        public function setnom_Est($nom_Est){
            $this->nom_Est = $nom_Est;
        }

        public function getnom_Est(){
            return $this->nom_Est;
        }

    }

?>