<?php

$servidor="localhost";
$usuario="root";
$contrasena="";
$basedatos="bdfactura";

$conexion=new mysqli($servidor,$usuario,$contrasena,$basedatos);

if($conexion->connect_errno){
    die("error:" .$conexion->connect_errno);
}

?>