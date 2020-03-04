<?php
namespace Piezas;

use Interfaces\Movible;

class Peon implements Movible {
    private $color;
    public function __construct($color){
        $color=$this->color;
    }
    
    public function mover ($x1, $y1, $x2, $y2, $tablero){ //return Bool
        if ($tablero->dame($x1,$y1) instanceof \Piezas\Peon and
         $tablero->dame($x2,$y2) instanceof \Piezas\PiezaNull){
            return True;
            }elseif($tablero[$x2][$y2]->esBlanco != $tablero[$x1][$y1]->esBlanco){
                return True;
            }else{
                return False;
            }
        }

    public function esBlanco (){ //return Bool
        if ($this->color=="blanco"){
            return True;
        }else{
            return False;
        }
    }
    public function nombre(){
        return "P";
    }
    

}