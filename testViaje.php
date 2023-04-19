<?php
require_once("Viaje.php");
require_once("Pasajeros.php");
require_once("ResponsableV.php");

/*Obliga al usuario ingresar un numero entre el rango de las variables $min y $max:
* @param int $min
* @param int $max
* @return int 
*/
function solicitarNumeroEntre($min, $max)
{
   //int $numero
   echo "\nEliga un opcion entre ".$min." y ".$max." : "; //Agregué una linea de interacción con el usuario
   $numero = trim(fgets(STDIN));
   while (!is_int($numero) && !($numero >= $min && $numero <= $max)) {
       echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
       $numero = trim(fgets(STDIN));
   }
   return (int)$numero;
}

/**  
 * FUNCION SELECCIONAR OPCION MENU: 
 * @return int
 */
function seleccionarOpcion(){
    // int $numeroDeOpcion 
    echo "\n*********************MENÚ DE OPCIONES********************* \n";
    echo "\n1- Cargar informacion del viaje.";
    echo"\n";
    echo "\n**PARA LA DEMAS OPCIONES DEBE HABER CARGADO AL MENOS UN VIAJE**";
    echo"\n";
    echo "\n2- Ver datos cargados.";
    echo "\n";
    echo "3- Modificar datos:";
    echo "\n";
    echo "4- Agregar un pasajero.";
    echo "\n";
    echo "5- Agregar un Responsable.";
    echo "\n";
    echo "\n********************************************************** \n";
    
    $numeroDeOpcion = solicitarNumeroEntre(1,5);
    return $numeroDeOpcion;
}

//FUNCION (Menú Volver al)
function  volverAlMenu (){
    // $opcionVolverMenu (cualquier tecla)
    echo "\n";
    echo " ** Presione cualquier tecla para volver al menu principal ** ";
    $opcionVolverMenu = trim(fgets( STDIN ));
        if ( $opcionVolverMenu == $opcionVolverMenu ){
    }
    
}
//Fin Modulo.

// PROGRAMA PRINCIPAL
// inicializacion de variable

do {
    $opcionMenu = seleccionarOpcion();
    switch ($opcionMenu) {
        case 1: //Cargar informacion del viaje.
            echo "Ingrese el codigo del viaje:";
            $codigo= strtolower(trim(fgets(STDIN)));
            echo "Ingrese el nombre del destino:";
            $destino= ucwords( trim(fgets(STDIN)));
            echo "Ingrese la cantidad maxima de pasajero:";
            $cantidadMax= trim(fgets(STDIN));
            echo "Cuanto Responsable desea agregar?";
            $numRes=trim(fgets(STDIN))-1;
                for($num=0; $num <= $numRes ; $num=$num + 1){
            echo "Ingrese los siguientes datos del responsable del viaje:\n";
            echo "El NUMERO de epleado: ";
               $numEmpleado=trim(fgets(STDIN));
               echo "El NUMERO de licencia: ";
               $numLicencia=trim(fgets(STDIN));
               echo "El nombre: ";
               $nombre=trim(fgets(STDIN));
               echo "El apellido:";
               $apellido=trim(fgets(STDIN));
               $responsableViaje[$num]= new ResponsableV($numEmpleado,$numLicencia,$nombre,$apellido);
            }
            // CARGAR DATOS DE PASAJEROS
            echo "Cuanto pasajero desea agregar?";
            $numPas=trim(fgets(STDIN))-1;
            if ($numPas<$cantidadMax){
            for($num=0; $num <= $numPas ; $num=$num + 1){
            echo "Ingrese nombre del pasajero:";
            $nombre=ucwords( trim(fgets(STDIN)));
            echo "Ingrese el apellido:";
            $apellido= ucwords( trim(fgets(STDIN)));
            echo "Ingrese el numero de dni:";
            $numDoc = trim(fgets(STDIN));
            echo "Ingrese el numero de telefono:";
            $telefono = trim(fgets(STDIN));
            $pasajero[$num]= new Pasajeros($nombre,$apellido,$numDoc,$telefono);
            }
            $viaje1= new Viaje($codigo, $destino,$cantidadMax,$pasajero,$responsableViaje);
            echo "\n";
            echo "LOS DATOS FUERON CARGADOS CORRECTAMENTE.";
            echo "\n";
            }
            else {
                echo "\n";
                echo"La cantidad de pasajero supera la cantidad maxima";
                echo "\n";
            }
            
            volverAlMenu();
        break;
        case 2:// Ver datos cargados.
            echo "LOS DATOS CARGADOS SON LOS SIGUIENTES:\n".$viaje1;
            volverAlMenu();
        break;
        case 3: //Modificar datos:
            echo "Escriba el NUMERO que corresponda al dato a modificar y presione ENTER:\n";
            echo "\nCodigo viaje= 1\n";
            echo "Destino= 2\n";
            echo "Cantidad pasajeros total= 3\n";
            echo "DATOS DE LOS PASAJEROS = 4\n";
            $opcion = trim(fgets(STDIN));
            if($opcion == 1) {
                echo "Ingrese el NUEVO codigo:";
                $nuevoCodigo=trim(fgets(STDIN));
                $viaje1-> setCodigo( $nuevoCodigo); // set me permite cambiar la variable
                echo "La nueva informacion del viaje es:\n". $viaje1;
            }
            else if($opcion == 2) {
                echo "Ingrese el NUEVO destino:";
                $nuevoDestino=trim(fgets(STDIN));
                $viaje1-> setDestino( $nuevoDestino); // set me permite cambiar la variable
                echo "\n La nueva informacion del viaje es:\n". $viaje1;
            }
            else if($opcion == 3) {
                echo "Ingrese la NUEVA cantidad TOTAL de pasajero:";
                $cantPas=trim(fgets(STDIN));
                $viaje1-> setCantMaxPasajero($cantPas); // set me permite cambiar la variable
                echo "La nueva informacion del viaje es:\n". $viaje1;
            }
            else if($opcion == 4) {
            echo "Escriba el NUMERO de DNI del pasajero a modificar y presione ENTER:\n";
            $numDoc = trim(fgets(STDIN));
            $indicePasajero=$viaje1->buscarPasajero($numDoc);
              if ( $indicePasajero >=0){
                 echo "Se encontro pasajero:\n";
                 echo "Que dato desea moficar: nombre, apellido o telefono?\n";
                 $datoModificar= trim(fgets(STDIN));
                   if($datoModificar == "nombre"){
                    echo "Ingrese el nuevo nombre:";
                    $nuevoNombre=trim(fgets(STDIN));
                    $colPas= $viaje1->getColPasajeros();
                    $numDoc =$colPas [$indicePasajero]->getNumeroDoc();
                    $apellido = $colPas [$indicePasajero]->getApellido();
                    $telefono=$colPas [$indicePasajero]->getTelefono();
                    $viaje1->modificarPasajero($nuevoNombre, $apellido,$numDoc,$telefono,$indicePasajero);
                    echo "Se modifico el pasajero ". $viaje1;
                   }
                   else if($datoModificar == "apellido"){
                    echo "Ingrese el nuevo apellido:";
                    $nuevoApellido=trim(fgets(STDIN));
                    $colPas= $viaje1->getColPasajeros();
                    $nombre = $colPas [$indicePasajero]->getNombre();
                    $telefono=$colPas [$indicePasajero]->getTelefono();
                    $numDoc =$colPas [$indicePasajero]->getNumeroDoc();
                    $viaje1->modificarPasajero($nombre, $nuevoApellido,$numDoc,$telefono,$indicePasajero);
                    echo "Se modifico el pasajero ". $viaje1;
                   }
                   else if($datoModificar == "telefono"){
                    echo "Ingrese el nuevo telefono:";
                    $nuevoTel=trim(fgets(STDIN));
                    $colPas= $viaje1->getColPasajeros();
                    $nombre = $colPas [$indicePasajero]->getNombre();
                    $apellido=$colPas [$indicePasajero]->getApellido();
                    $numDoc =$colPas [$indicePasajero]->getNumeroDoc();
                    $viaje1->modificarPasajero($nombre, $apellido,$numDoc,$nuevoTel,$indicePasajero);
                    echo "Se modifico el pasajero ". $viaje1;
                   }
               }

               else{
                 echo "NO se encontraron datos que coincidan con ese pasajero";}
               }
                volverAlMenu();
        break;   
        case 4: //agregar un pasajero
            echo "Ingrese nombre del pasajero:";
            $nombre=ucwords( trim(fgets(STDIN)));
            echo "Ingrese el apellido:";
            $apellido= ucwords( trim(fgets(STDIN)));
            echo "Ingrese el numero de dni:";
            $numDoc = trim(fgets(STDIN));
            echo "Ingrese el telefono:";
            $telefono= trim(fgets(STDIN));
            $nuevoPasajero= new Pasajeros($nombre,$apellido,$numDoc,$telefono);
            $existe=$viaje1->CargarDatosPasajeros($nuevoPasajero) ;
            if($existe == true){
            
                echo "Se agrego  el pasajero ".$viaje1;
            }
            else{
                echo "NO SE PUEDE CARGAR PASAJERO YA QUE SE ENCUENTRA EN LA LISTA.";
            }
            volverAlMenu();
        break;
        case 5: //agregar un RESPONSABLE
            echo "El NUMERO de epleado: ";
               $numEmpleado=trim(fgets(STDIN));
               echo "El NUMERO de licencia: ";
               $numLicencia=trim(fgets(STDIN));
               echo "El nombre: ";
               $nombre=trim(fgets(STDIN));
               echo "El apellido:";
               $apellido=trim(fgets(STDIN));
               $nuevoResponsable= new ResponsableV($numEmpleado,$numLicencia,$nombre,$apellido);
               $existe=$viaje1->CargarDatosResponsable($nuevoResponsable) ;
            if($existe == true){
            
                echo "Se agrego  el Responsable ".$viaje1;
            }
            else{
                echo "NO SE PUEDE CARGAR El RESPONSABLE YA EXISTE UN RESPONSABLE CON ESE NUM DE LICENCIA";
            }
            volverAlMenu();
        break;
}
} while ($opcionMenu !=6);