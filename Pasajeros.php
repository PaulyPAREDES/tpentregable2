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

 public function getApellido(){
     return $this->apellido;
    }
 public function setApellido($apellido){
    $this->apellido= $apellido;
    } 

 public function getNumeroDoc(){
     return $this->numeroDoc;
    }
 public function setNumeroDoc($numeroDoc){
    $this->numeroDoc= $numeroDoc;
    }

 public function getTelefono(){
     return $this->telefono;
    }
 public function setTelefono($telefono){
     $this->telefono= $telefono;
    }   
  //Metodo __tostring
 public function __toString()  
 {
    $cadena="";
    $cadena="Nombre:".$this->getNombre()."\nApellido:".$this->getApellido()."\nNumero dni:".$this->getNumeroDoc()
    ."\nTelefono:".$this->getTelefono()."\n";
    return $cadena;
 }

}