<?php
require_once("../vendor/autoload.php");
require_once("../Tablero.php");

use PHPUnit\Framework\TestCase;
use Piezas\PiezaNull;

final class TableroTest extends TestCase
{

    public function testExisteTablero(){
        $this->assertTrue(class_exists("Tablero"));
    }
    public function testAsignoUnNumeroAUnaPosiciondeTablero(){
        $ajedrez= new Tablero;
        $tablero=$ajedrez->mostrar();
        $tablero[1][1]=3;
        $this->assertEquals(3,$tablero[1][1]);
    }
    public function testAsignoUnaPiezaAPosicionDelTableroManualmente(){
        $ajedrez= new Tablero;
        $tablero=$ajedrez->mostrar();
        $color="blanco";
        $caballo= new \Piezas\Caballo($color);
        $tablero[3][3]= $caballo;
        $this->assertEquals($caballo,$tablero[3][3]);
    }
    public function testAsignounaPiezaAlTablero(){
        $ajedrez= new Tablero;
        $color="blanco";
        $caballo= new \Piezas\Caballo($color);
        $ajedrez->colocarPieza(3,3,$caballo);
        $tablero=$ajedrez->mostrar();
        $this->assertEquals($caballo,$tablero[3][3]);
    }
    public function testDame(){
        $ajedrez= new Tablero;
        $color="blanco";
        $pnull= new \Piezas\PiezaNull($color);
        $caballo= new \Piezas\Caballo($color);
        $ajedrez->colocarPieza(3,3,$caballo);
        $this->assertEquals($caballo,$ajedrez->dame(3,3));
        $this->assertEquals($pnull,$ajedrez->dame(2,3));
    }
    public function testMoverunaPieza(){
        $ajedrez= new Tablero;
        $blanco="blanco";
        $negro="negro";
        $pnull= new \Piezas\PiezaNull($negro);
        $caballo= new \Piezas\Caballo($blanco);
        $ajedrez->colocarPieza(3,3,$caballo);
        
        $this->assertFalse($ajedrez->mover(3,3,2,3));
        $this->assertTrue($ajedrez->dame(2,3) instanceof \Piezas\PiezaNull);
    }
    
    public function testTermino(){
        $ajedrez= new Tablero;
        $rey= new \Piezas\Rey("negro");
        $this->assertTrue($ajedrez->colocarPieza(3,3,$rey));
        $rey2= new \Piezas\Rey("blanco");
        $this->assertTrue($ajedrez->colocarPieza(6,6,$rey2));
        $this->assertFalse($ajedrez->termino());
        $caballo= new \Piezas\Caballo("blanco");
        $this->assertTrue($ajedrez->colocarPieza(2,3,$caballo));
        $this->assertEquals($caballo, $ajedrez->dame(2,3));
        $this->assertFalse($ajedrez->mover(2,3,3,3));
    }
    public function testMoverUnaTorreyComer(){
        $ajedrez= new Tablero;
        $torre= new \Piezas\Torre("negro");
        $rey= new \Piezas\Rey("blanco");
        $rey2= new \Piezas\Rey("blanco");
        $this->assertTrue($ajedrez->colocarPieza(6,6,$rey2));
        $this->assertTrue($ajedrez->colocarPieza(3,3,$torre));
        $this->assertTrue($ajedrez->mover(3,3,2,3));
        $this->assertTrue($ajedrez->mover(2,3,2,2));
        $this->assertTrue($ajedrez->dame(2,2) instanceof \Piezas\Torre);
        $this->assertTrue($ajedrez->mover(2,2,2,5));
        $this->assertTrue($ajedrez->colocarPieza(4,5,$rey));
        $this->assertTrue($ajedrez->mover(2,5,4,5));

        $this->assertTrue($ajedrez->termino());
    
    }
    public function testMoverUnCaballoyComer(){
        $ajedrez= new Tablero;
        $caballo= new \Piezas\Caballo("negro");
        $this->assertTrue($ajedrez->colocarPieza(4,4,$caballo));
        $this->assertTrue($ajedrez->mover(4,4,2,3));
        $this->assertTrue($ajedrez->mover(2,3,4,4));
        $this->assertFalse($ajedrez->mover(4,4,4,3));
        $caballo2= new \Piezas\Caballo("negro");
        $this->assertTrue($ajedrez->colocarPieza(2,3,$caballo2));
        $this->assertEquals($caballo2, $ajedrez->dame(2,3));
        $this->assertTrue($ajedrez->mover(2,3,3,5));
        $rey= new \Piezas\Rey("blanco");
        $this->assertTrue($ajedrez->colocarPieza(2,3,$rey));
        $this->assertTrue($ajedrez->mover(4,4,2,3));
        $rey2= new \Piezas\Rey("blanco");
        $this->assertTrue($ajedrez->colocarPieza(6,6,$rey2));
        $this->assertTrue($ajedrez->termino());
    }
    public function testMoverUnAlfilyComer(){
        $ajedrez= new Tablero;
        $alfil= new \Piezas\Alfil("blanco");
        $this->assertTrue($ajedrez->colocarPieza(3,3,$alfil));
        $this->assertTrue($ajedrez->mover(3,3,6,6));
        $this->assertTrue($ajedrez->dame(4,4) instanceof \Piezas\PiezaNull);
        $caballo= new \Piezas\Caballo("negro");
        $this->assertTrue($ajedrez->colocarPieza(4,4,$caballo));
        $this->assertTrue($ajedrez->mover(6,6,4,4));
        $rey= new \Piezas\Rey("negro");
        $this->assertTrue($ajedrez->colocarPieza(2,2,$rey));
        $this->assertTrue($ajedrez->mover(4,4,2,2));
        $rey2= new \Piezas\Rey("blanco");
        $this->assertTrue($ajedrez->colocarPieza(6,6,$rey2));
        $this->assertTrue($ajedrez->termino());

    }
    public function testMoverunaDamayComer(){
        $ajedrez= new Tablero;
        $dama= new \Piezas\Dama("negro");
        $this->assertTrue($ajedrez->colocarPieza(3,3,$dama));
        $this->assertTrue($ajedrez->mover(3,3,5,5));
        $this->assertTrue($ajedrez->mover(5,5,1,5));
        $this->assertTrue($ajedrez->mover(1,5,1,3));
    }

}