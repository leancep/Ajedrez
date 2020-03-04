<?php
namespace Piezas;

use Interfaces\Movible;

class PiezaNull implements Movible {
    private $color;
    public function __construct($color){
        $color=$this->color;
    }
    
    public function mover ($x1, $y1, $x2, $y2, $tablero){ //return Bool
        return null;
    }

    public function esBlanco (){ //return Bool
        if ($this->color=="blanco"){
            return True;
        }else{
            return False;
        }
    }
    public function nombre(){
        return "";
    }

}