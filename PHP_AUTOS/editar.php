<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar Registros Mysql Mediante Funcion</title>
<link type="text/css" href="bootstrap.min.css" rel="stylesheet">
<link type="text/css" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
<style>
table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    text-align: left;
    padding: 4px;
}
tr:nth-child(even){background-color: #f2f2f2}
th {
    background-color: #4CAF50;
    color: white;
}
.main-wrapper{
	width:50%;
	
	background:#E0E4E5;
	border:1px solid #292929;
	padding:25px;
}
hr {
    margin-top: 5px;
    margin-bottom: 5px;
    border: 0;
    border-top: 1px solid #eee;
}
</style>
</head>

<body>
<div class="main-wrapper">
<h1>Editar información de auto</h1>
<br><br>
<?php 
include("function.php");
$ID_Auto = $_GET['ID_Auto'];
select_id('auto','ID_Auto',$ID_Auto);
?>
<form action="" method="post">
	<input type="text" value="<?php echo $row->marca;?>" name="marca">
	<input type="text" value="<?php echo $row->modelo;?>" name="modelo">
	<input type="text" value="<?php echo $row->descripcion;?>" name="descripcion">
	<input type="text" value="<?php echo $row->precio;?>" name="precio">
	<input type="text" value="<?php echo $row->tipo;?>" name="tipo">
	<input type="text" value="<?php echo $row->niv;?>" name="niv">
	<input type="text" value="<?php echo $row->nro_motor;?>" name="nro_motor">
	<input type="text" value="<?php echo $row->nro_chasis;?>" name="nro_chasis">
	<input type="submit" name="submit">
</form>

<?php
	
	if(isset($_POST['submit'])){
		$field = array("marca"=>$_POST['marca'], "modelo"=>$_POST['modelo'],"descripcion"=>$_POST['descripcion'],"precio"=>$_POST['precio'],"tipo"=>$_POST['tipo'],"niv"=>$_POST['niv'],"nro_motor"=>$_POST['nro_motor'],"nro_chasis"=>$_POST['nro_chasis']);
		$tbl = "auto";
		edit($tbl,$field,'ID_Auto',$ID_Auto);
		header("location:index.php");
	}

	
?>
</div>
</body>
</html>