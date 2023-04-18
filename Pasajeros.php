<?php
class Pasajeros{
 //ATRIBUTOS
private $nombre;
private $apellido;
private $numeroDoc;
private $telefono;

// metodo contrusctor
public function __construct($nombre,$apellido,$numeroDoc,$telefono){
 $this->nombre=$nombre;
 $this->apellido=$apellido;
 $this->numeroDoc=$numeroDoc;
 $this->telefono=$telefono;
}
// metodos de accesos get y set

public function getNombre(){
     return $this->nombre;
    }
public function setNombre($nombre){
   $this->nombre= $nombre;
    }

}