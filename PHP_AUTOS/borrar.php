<?php 
include("function.php");
$id = $_GET['ID_Auto'];
delete('auto','ID_Auto',$ID_Auto);
header("location:index.php");
?>