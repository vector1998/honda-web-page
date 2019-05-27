<?php 
include("function.php");
$ID_vendedor = $_GET['ID_vendedor'];
delete('vendedor','ID_vendedor',$ID_vendedor);
header("location:index.php");
?>