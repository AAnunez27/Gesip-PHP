<?php

    class Rol {

        private $id_rol;
        private $nom_rol;

        public function __construct($id_rol,$nom_rol){
            $this->id_rol = $id_rol;
            $this->nom_rol = $nom_rol;
        }

        public function setid_rol($id_rol){
            $this->id_rol = $id_rol;
        }

        public function getid_rol(){
            return $this->id_rol;
        }

        public function setnom_rol($nom_rol){
            $this->nom_rol = $nom_rol;
        }

        public function getnom_rol(){
            return $this->nom_rol;
        }

    }

?>