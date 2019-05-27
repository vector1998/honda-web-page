<?php
//variables
$server="localhost";
$user="root";
$password="";
$db="agencia";

//conexión
$connection= new mysqli($server,$user,$password,$db);

//checar coneexiones
if($connection->connect_error){
   die("fallo en la conexion".$connection->connect_error);
}

$fecha=$_GET['fecha_pago'];
$id=$_GET['id'];

//Actualizar db
$query="update infopagos set estado='P' where ID_Factura=".$id." and fecha_pago="."'".$fecha."'";

$connection->query($query);
    
   
//cerrar conexion
$connection->close();

header('location: index.php');
?>