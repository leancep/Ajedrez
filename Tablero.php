<?php

use Piezas\PiezaNull;

class Tablero {
    private $x=8;
    private $y=8;
    private $tablero=array();
    private $color="";
    

    public function __construct()
    {
        
        for ($i=0;$i<$this->x;$i++){
            $this->tablero[$i]=array();
            for($j=0;$j<$this->y;$j++){
                $this->tablero[$i][$j]= false;
            }
        }
    }

    public function mostrar(){
        return $this->tablero;
    }

    public function colocarPieza($x, $y, $pieza){ // Return Bool
        if (empty($this->tablero[$x][$y])){
        $this->tablero[$x][$y]=$pieza;
        return True;
        }else{
            return False;
        }
     
    }

    public function mover ($x1, $y1, $x2, $y2){ //Return Bool
        if (!$this->posicionValida($x1, $y1)
                || !$this->posicionValida($x2, $y2)) {
            return false;
        }
        $actual= $this->dame($x1,$y1);
        $objetivo= $this->dame($x2,$y2);
        if ($actual->mover($x1, $y1, $x2, $y2, $this)==True){
            $this->tablero[$x2][$y2]=$actual;
            $this->tablero[$x1][$y1]=false;
            
            return True;
        }else{
            return False;
        }
     }
    
    public function termino (){
        $cont=0;
        for ($i=0;$i<$this->x;$i++){
            for($j=0;$j<$this->y;$j++){
                if($this->dame($i,$j) instanceof \Piezas\Rey){
                    $cont++;
                }
            }
        }
        if ($cont==1){
        return True;
        }else{
            return False;
        }
    }
    

    public function dame ($x, $y){
        if (empty($this->tablero[$x][$y])){
            return new \Piezas\PiezaNull("blanco");
        }
        return $this->tablero[$x][$y];
    }
    private function posicionValida($x, $y) {
        if ($x < 0 || $y < 0) {
            return false;
        }
        if ($x > 7 || $y > 7) {
            return false;
        }
        return true;
    }

}