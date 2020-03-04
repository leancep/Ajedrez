<?php
namespace Piezas;

use Interfaces\Movible;

class Rey implements Movible {
    private $color;
    public function __construct($color){
        $this->color=$color;
    }
    
    public function mover ($x1, $y1, $x2, $y2, $tablero){ //return Bool
        if (($x2==$x1+1 and $y1==$y2)  or ($x2==$x1-1 and $y1==$y2) or
            ($x1==$x2 and $y1==$y2+1) or ($x1==$x2 and $y1==$y2-1) or
            ($x2==$x1-1 and $y2==$y1+1) or ($x2==$x1+1 and $y2==$y1+1) or
            ($x2==$x1-1 and $y2==$y1-1) or ($x2==$x1+1 and $y2==$y1-1)){

            if ($tablero->dame($x2,$y2) instanceof \Piezas\PiezaNull){
                return True;
            }elseif($tablero->dame($x2,$y2)->esBlanco() !== $tablero->dame($x1,$y1)->esBlanco()){
                return True;
            }else{
                return False;
            }
        }
        return False;
    }

    public function esBlanco (){ //return Bool
        if ($this->color=="blanco"){
            return True;
        }else{
            return False;
        }
    }
    public function nombre(){
        return "R";
    }
    

}