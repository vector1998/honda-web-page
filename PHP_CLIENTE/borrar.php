<?php 
include("function.php");
$ID_cliente = $_GET['ID_cliente'];
delete('cliente','ID_cliente',$ID_cliente);
header("location:index.php");
?>