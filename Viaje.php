<?php
require_once("Pasajeros.php");
require_once("ResponsableV.php");

class Viaje{
 //ATRIBUTOS
    private $codigo;
    private $destino;
    private $cantMaxPasajero;
    private $colPasajeros;
    private $objResponsableV;

 // METODOS
    public function __construct($codigo,$destino,$cantMaxPasajero,$colPasajeros,$objResponsableV)// permite cargar los valores
    {
        $this->codigo=$codigo;
        $this->destino =$destino;
        $this->cantMaxPasajero = $cantMaxPasajero;
        $this->colPasajeros=$colPasajeros;
        $this->objResponsableV=$objResponsableV;
    }
// metodos get y set
    public function getCodigo(){
     return $this->codigo;
    }
    public function setCodigo($codigo){
   $this->codigo= $codigo;
    }

    public function getDestino(){
        return $this->destino;
    }
    public function setDestino($destino){
       $this->destino= $destino;
    }

    public function getCantMaxPasajero(){
        return $this->cantMaxPasajero;
    }
    public function setcantMaxPasajero($cantMaxPasajero){
       $this->cantMaxPasajero= $cantMaxPasajero;
    }

    public function getColPasajeros(){
        return $this->colPasajeros;
    }
    public function setColPasajeros($colPasajeros){
       $this->colPasajeros= $colPasajeros;
    }

    public function getObjResponsableV(){
        return $this->objResponsableV;
    }
    public function setObjResponsableV($objResponsableV){
       $this->objResponsableV= $objResponsableV;
    }

 //Metodo __tostring
 public function __toString()
 {
    $cadena="";
    $cadena="DATOS DEL VIAJE:\n Codigo:".$this->getCodigo()."\n Destino:".$this->getDestino()."\n Cantidad maxima de pasajeros:".$this->getCantMaxPasajero()."\n"
    ."\n DATOS DE LOS PASAJEROS:\n".$this->mostrarDatosPasajeros()."\n"."\n DATOS DE LOS RESPONSABLE:\n".$this-> mostrarDatosResponsable()."\n";
    return $cadena;
 }


  // funcion mostrar pasajero
 private function mostrarDatosPasajeros()
 {
    $coleccion = $this->getColPasajeros();
    $mensaje = "";
    $cantidad = count($coleccion);
    for ($i = 0; $i < $cantidad; $i++) {
            $mensaje = $mensaje ."\n". $coleccion[$i];
        }
    return $mensaje;
}
// funcion mostrar datos responsable
private function mostrarDatosResponsable()
{
    $coleccionResp = $this->getObjResponsableV();
    $mensaje = "";
    $cantidad = count($coleccionResp);
    for ($i = 0; $i < $cantidad; $i++) {
            $mensaje = $mensaje ."\n".$coleccionResp[$i];
        }
    return $mensaje;
}

 //Funcion permite cargar datos pasajeros
 public function CargarDatosPasajeros($nuevoPasajero) {
 $colPasajeros= $this->getColPasajeros();
 $exito=false;
 $encontro=false;
 $i=0;
 while ($i< count($colPasajeros) && !$encontro){
    $unPasajero= $colPasajeros[$i];
    if($unPasajero->getNumeroDoc()==$nuevoPasajero->getNumeroDoc()){
        $encontro=true;
    }
    $i++;
 }
 if (!$encontro){
    $colPasajeros[]=$nuevoPasajero;
    $this->setColPasajeros( $colPasajeros);
    $exito= true;
}
return $exito;
 }

 //Funcion permite cargar datos responsable
 public function CargarDatosResponsable($nuevoResponsable) {
    $colResponsable= $this->getObjResponsableV();
    $encontro=false;
    $exito=false;
    $i=0;
    while ($i< count($colResponsable) && !$encontro){
       $unResponsable=$colResponsable[$i];
       if($unResponsable->getNumLicencia()==$nuevoResponsable->getNumLicencia()){
           $encontro=true;
       }
       $i++;
    }
    if (!$encontro){
        $colResponsable[]=$nuevoResponsable;
       $this->setObjResponsableV($colResponsable);
       $exito= true;
    }
    return $exito;
    }

//Funcion Buscar pasajero por su dni, retorna el indice
public function buscarPasajero($dniPas){
    $colPas=$this->getColPasajeros();;
    $indice=-1;
    $i=0;
    while($i<count($colPas)){
        if ($colPas[$i]->getNumeroDoc()==$dniPas){
            $indice=$i; 
        }
        $i=$i+1;
    }
    return $indice;
}
//Funcion Modificar pasajeros con los nuevos datos.
 public function modificarPasajero($nombre,$apellido,$numDoc,$telefono, $indice){
   
        $colPas= $this-> getColPasajeros();
        $colPas[$indice]->setNombre($nombre);
        $colPas[$indice]->setApellido($apellido);
        $colPas[$indice]->setNumeroDoc($numDoc);
        $colPas[$indice]->setTelefono($telefono);
        $colPas=$this->setColPasajeros( $colPas);
    return $colPas;
}
}