<?php 
include("function.php");
$id = $_GET['ID_Factura'];
delete('factura','ID_Factura',$id);
header("location:index.php");
?>