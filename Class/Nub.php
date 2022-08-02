<?php

    class Nub {

        private $id_nub;
        private $id_rol;
        private $id_usu;

        public function __construct($id_nub,$id_rol,$id_usu){
            $this->id_nub = $id_nub;
            $this->id_rol = $id_rol;
            $this->id_usu = $id_usu;
        }

        public function setid_nub($id_nub){
            $this->id_nub = $id_nub;
        }

        public function getid_nub(){
            return $this->id_nub;
        }

        public function setid_rol($id_rol){
            $this->id_rol = $id_rol;
        }

        public function getid_rol(){
            return $this->id_rol;
        }
        public function setid_usu($id_usu){
            $this->id_usu = $id_usu;
        }

        public function getid_usu(){
            return $this->id_usu;
        }

    }

?>