<?php

    class Dispositivo {

        private $id_dis;
        private $nom_dis;
        private $ser_dis;
        private $cod_dis;
        private $alm_dis;
        private $obs_dis;
        private $id_tip;
        private $id_mar;
        private $id_So;
        private $id_pro;
        private $mod_dis;
        private $id_est;

        public function __construct($id_dis,$nom_dis,$ser_dis,$cod_dis,$alm_dis,$obs_dis,$id_tip,$id_mar,$id_So,$id_pro,$mod_dis, $id_est){
            $this->id_dis = $id_dis;
            $this->nom_dis = $nom_dis;
            $this->ser_dis = $ser_dis;
            $this->cod_dis = $cod_dis;
            $this->alm_dis = $alm_dis;
            $this->obs_dis = $obs_dis;
            $this->id_tip = $id_tip;
            $this->id_mar = $id_mar;
            $this->id_So = $id_So;
            $this->id_pro = $id_pro;
            $this->mod_dis =$mod_dis;
            $this->id_est = $id_est;
        }

        public function setid_dis($id_dis){
            $this->id_dis = $id_dis;
        }

        public function getid_dis(){
            return $this->id_dis;
        }

        public function setnom_dis($nom_dis){
            $this->nom_dis = $nom_dis;
        }

        public function getnom_dis(){
            return $this->nom_dis;
        }

        public function setser_dis($ser_dis){
            $this->ser_dis = $ser_dis;
        }

        public function getser_dis(){
            return $this->ser_dis;
        }

        public function setcod_dis($cod_dis){
            $this->cod_dis = $cod_dis;
        }

        public function getcod_dis(){
            return $this->cod_dis;
        }
        public function setalm_dis($alm_dis){
            $this->alm_dis = $alm_dis;
        }

        public function getalm_dis(){
            return $this->alm_dis;
        }

        public function setobs_dis($obs_dis){
            $this->obs_dis = $obs_dis;
        }

        public function getobs_dis(){
            return $this->obs_dis;
        }
        public function setid_tip($id_tip){
            $this->id_tip = $id_tip;
        }

        public function getid_tip(){
            return $this->id_tip;
        }

        public function setid_mar($id_mar){
            $this->id_mar = $id_mar;
        }

        public function getid_mar(){
            return $this->id_mar;
        }
        public function setId_So($id_So){
            $this->id_So = $id_So;
        }

        public function getId_So(){
            return $this->id_So;
        }

        public function setid_pro($id_pro){
            $this->id_pro = $id_pro;
        }

        public function getid_pro(){
            return $this->id_pro;
        }
        public function setmod_dis($mod_dis){
            $this->mod_dis = $mod_dis;
        }

        public function getmod_dis(){
            return $this->mod_dis;
        }

        public function setid_est($id_est){
            $this->id_est = $id_est;
        }

        public function getid_est(){
            return $this->id_est;
        }

    }

?>