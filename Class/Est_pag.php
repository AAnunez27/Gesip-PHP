<?php

    class Est_Pag {

        private $id_spa;
        private $id_est;

        public function __construct($id_spa,$id_est){
            $this->id_spa = $id_spa;
            $this->id_est = $id_est;
        }

        public function setid_spa($id_spa){
            $this->id_spa = $id_spa;
        }

        public function getid_spa(){
            return $this->id_spa;
        }
        
        public function setid_est($id_est){
            $this->id_est = $id_est;
        }

        public function getid_est(){
            return $this->id_est;
        }
    }

?>