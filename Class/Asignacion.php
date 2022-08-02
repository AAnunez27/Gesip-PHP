<?php

    class Asignacion {

        private $id_asi;
        private $obs_asi;
        private $fece_asi;
        private $fecd_asi;
        private $id_ubi;
        private $id_dis;
        private $id_usu;
        private $id_est;

        public function __construct($id_asi,$obs_asi,$fece_asi,$fecd_asi,$id_ubi,$id_dis,$id_usu,$id_est){
            $this->id_asi = $id_asi;
            $this->obs_asi = $obs_asi;
            $this->fece_asi = $fece_asi;
            $this->fecd_asi = $fecd_asi;
            $this->id_ubi = $id_ubi;
            $this->id_dis = $id_dis;
            $this->id_usu = $id_usu;
            $this->id_est = $id_est;
        }

        public function setid_asi($id_asi){
            $this->id_asi = $id_asi;
        }

        public function getid_asi(){
            return $this->id_asi;
        }

        public function setobs_asi($obs_asi){
            $this->obs_asi = $obs_asi;
        }

        public function getobs_asi(){
            return $this->obs_asi;
        }
        public function setfece_asi($fece_asi){
            $this->fece_asi = $fece_asi;
        }

        public function getfece_asi(){
            return $this->fece_asi;
        }

        public function setfecd_asi($fecd_asi){
            $this->fecd_asi = $fecd_asi;
        }

        public function getfecd_asi(){
            return $this->fecd_asi;
        }
        public function setid_ubi($id_ubi){
            $this->id_ubi = $id_ubi;
        }

        public function getid_ubi(){
            return $this->id_ubi;
        }

        public function setid_dis($id_dis){
            $this->id_dis = $id_dis;
        }

        public function getid_dis(){
            return $this->id_dis;
        }
        public function setid_usu($id_usu){
            $this->id_usu = $id_usu;
        }

        public function getid_usu(){
            return $this->id_usu;
        }

        public function setid_est($id_est){
            $this->id_est = $id_est;
        }

        public function getid_est(){
            return $this->id_est;
        }

    }

?>