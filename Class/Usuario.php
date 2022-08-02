<?php

    class Usuario {

        private $id_usu;
        private $nom_usu;
        private $apep_usu;
        private $apem_usu;
        private $rut_usu;
        private $con_usu;
        private $dir_usu;
        private $fec_usu;
        private $id_gen;
        private $id_est;
        private $id_rol;

        public function __construct($id_usu,$nom_usu,$apep_usu,$apem_usu,$rut_usu,$con_usu,$dir_usu,$fec_usu,$id_gen,$id_est,$id_rol){
            $this->id_usu = $id_usu;
            $this->nom_usu = $nom_usu;
            $this->apep_usu = $apep_usu;
            $this->apem_usu = $apem_usu;
            $this->rut_usu = $rut_usu;
            $this->con_usu = $con_usu;
            $this->dir_usu = $dir_usu;
            $this->fec_usu = $fec_usu;
            $this->id_gen = $id_gen;
            $this->id_est = $id_est;
            $this->id_rol = $id_rol;
        }
        

        public function setid_usu($id_usu){
            $this->id_usu = $id_usu;
        }

        public function getid_usu(){
            return $this->id_usu;
        }

        public function setnom_usu($nom_usu){
            $this->nom_usu = $nom_usu;
        }

        public function getnom_usu(){
            return $this->nom_usu;
        }
        public function setapep_usu($apep_usu){
            $this->apep_usu = $apep_usu;
        }

        public function getapep_usu(){
            return $this->apep_usu;
        }

        public function setapem_usu($apem_usu){
            $this->apem_usu = $apem_usu;
        }

        public function getapem_usu(){
            return $this->apem_usu;
        }

        public function setrut_usu($rut_usu){
            $this->rut_usu = $rut_usu;
        }

        public function getrut_usu(){
            return $this->rut_usu;
        }

        public function setcon_usu($con_usu){
            $this->con_usu = $con_usu;
        }

        public function getcon_usu(){
            return $this->con_usu;
        }
        public function setdir_usu($dir_usu){
            $this->dir_usu = $dir_usu;
        }

        public function getdir_usu(){
            return $this->dir_usu;
        }

        public function setfec_usu($fec_usu){
            $this->fec_usu = $fec_usu;
        }

        public function getfec_usu(){
            return $this->fec_usu;
        }
        public function setid_gen($id_gen){
            $this->id_gen = $id_gen;
        }

        public function getid_gen(){
            return $this->id_gen;
        }

        public function setid_est($id_est){
            $this->id_est = $id_est;
        }

        public function getid_est(){
            return $this->id_est;
        }
        public function setid_rol($id_rol){
            $this->id_rol = $id_rol;
        }

        public function getid_rol(){
            return $this->id_rol;
        }

    }

?>