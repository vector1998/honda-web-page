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
<h1>Editar Información del Cliente </h1>
<br><br>
<?php 
include("function.php");
$ID_cliente = $_GET['ID_cliente'];
select_id('cliente','ID_cliente',$ID_cliente);
?>
<form action="" method="post">
	<input type="text" value="<?php echo $row->nombre;?>" name="nombre">
	<input type="text" value="<?php echo $row->curp;?>" name="curp">
	<input type="text" value="<?php echo $row->rfc;?>" name="rfc">
	<input type="text" value="<?php echo $row->domicilio;?>" name="domicilio">
	<input type="submit" name="submit">
</form>

<?php
	
	if(isset($_POST['submit'])){
		$field = array("nombre"=>$_POST['nombre'], "curp"=>$_POST['curp'],"rfc"=>$_POST['rfc'],"domicilio"=>$_POST['domicilio']);
		$tbl = "cliente";
		edit($tbl,$field,'ID_cliente',$ID_cliente);
		header("location:index.php");
	}

	
?>
</div>
</body>
</html>