<?php
    class Mosca{
        private $tipo;
        private $vida;

        public function __construct(){
            $this->tipo;
            $this->vida = 4;
        }

        public function getTipo(){

            return $this->tipo;
        }

        public function getVidas(){
            return $this->vidas;
        }

        public function TipoMosca(){
            $num = rand(1, 4);
            if($num == 1){
                $this->tipo = 'corriente';
                
            }
            if($num == 2){
                $this->tipo = 'verde';
            }
            if($num == 3){
                $this->tipo = 'negra';
            }
            if($num == 4){
                $this->tipo = 'domestica';
            }
            return $this->tipo;
        }
    }

    class Tablero{
        private $tabla;
        public static $N=19;

        public function __construct(){
            $this->tabla=array();
        }

        /**
         * Get the value of tabla
         */ 
        public function getTabla($i)
        {
                
                return $this->tabla[$i];
        }

        /**
         * Set the value of tabla
         *
         * @return  self
         */ 
        public function setTabla($tabla)
        {
                $this->tabla = $tabla;

                return $this;
        }

        public function escondidaMosca(){
            for($i = 0; $i < 5; $i++){
                $this->tabla[$i] = "  ";
            }
        }
        
        public function colocandoMosca(){
            $this->tabla[rand(0, count($this->tabla))] = "*";
        }

        public function getMaximo(){
            return count($this->tabla);
        }

        public function mostrandoTablas(){
            $mensaje;
            for ($i=0; $i < count($this->tabla) ; $i++) { 
                $mensaje = [
                    $i => $this->tabla,
                ];
            }
            
            
            return $mensaje;
        }
    }
?>