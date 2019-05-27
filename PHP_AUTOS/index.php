<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no,
		initial-scale=1.0,maximium-scale=1.0,minimum-scale=1.0">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,600,700">
		<link rel="stylesheet" href="css/efectos2.css">
		<title>Autos</title>
		<link type="text/css" href="bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<style>
			table {
			    border-collapse: collapse;
			    width: 100%;
			}
			th, td {
			    text-align: left;
			    padding: 4px;
			}
			tr:nth-child(even){
				background-color: #f2f2f2
			}
			th {
			    background-color: #000;
			    color: #fb2626;
			}
			.main-wrapper{
				width:60%;
				background:#E0E4E5;
				border:1px solid #292929;
				padding:25px;
				margin:auto;
			}
			hr {
			    margin-top: 5px;
			    margin-bottom: 5px;
			    border: 0;
			    border-top: 1px solid #eee;
			}
			h1{
				font-size:24px;
				}
		</style>
	</head>

	<header>
		<div class="contenedor">
			<nav class="menu">
				<a onClick="window.location.href='http://localhost/INICIO/index.html'" ,id="btn-inicio">Inicio</a>
				<a onClick="window.location.href='http://localhost/PHP_AUTOS'" ,id="btn-acerca-de">Autos</a>
				<a onClick="window.location.href='http://localhost/PHP_CLIENTE'" ,id="btn-menu">Clientes</a>
				<a onClick="window.location.href='http://localhost/PHP_VENDEDOR'" ,id="btn-galeria">Vendedores</a>
				<a onClick="window.location.href='http://localhost/PHP_COTIZACION'" ,id="btn-galeria">Cotización</a>
				<a onClick="window.location.href='http://localhost/PHP_FACTURA'" ,id="btn-galeria">Factura</a>
				<a onClick="window.location.href='http://localhost/PHP_VENTA'" ,id="btn-galeria">Venta</a>
				<a onClick="window.location.href='http://localhost/PHP_PAGOS'" ,id="btn-galeria">Cobranza</a>
			</nav>
		</div>
	</header>
	<body>
		<section class="main">
		<br><br>
	<div class="main-wrapper">
	<h1>Registro de Autos</h1>
	<br><br>
	<form action="" method="post">
		<div class="col-xs-3">
			<label>Marca</label>
			<input class="form-control" name="marca" type="text" placeholder="Marca">
		</div>
		<div class="col-xs-3">
			<label>Modelo</label>
			<input class="form-control" name="modelo" type="text" placeholder="Modelo">
		</div>
		<div class="col-xs-3">
			<label>Descripcion</label>
			<input class="form-control" name="descripcion" type="text" placeholder="Modelo">
		</div>  
		<div class="col-xs-3">
			<label>Precio</label>
	    	<input class="form-control" name="precio" type="text" placeholder="Precio">
		</div> 
		<div class="col-xs-3">
			<br>
			<label>Tipo</label>
	    	<input class="form-control" name="tipo" type="text" placeholder="Tipo">
		</div> 
		<div class="col-xs-3">
			<br>
			<label>NIV</label>
		 	<input class="form-control" name="niv" type="text" placeholder="NIV">
		 	<br><br>
		</div>
		<div class="col-xs-3">
			<br>
			<label>Número Motor</label>
		 	<input class="form-control" name="nro_motor" type="text" placeholder="Numero Motor">
		 	<br><br>
		</div>
		<div class="col-xs-3">
			<br>
			<label>Número Chasis</label>
		 	<input class="form-control" name="nro_chasis" type="text" placeholder="Numero Chasis">
		 	<br><br>
		</div>
		<br><br><br>
		<label></label>
		<br><br>  
			<input type="submit" name="submit" class="btn btn-primary" value="Insertar">
			<br>
	</form>
	<br>

	<?php
		include("function.php");
		if(isset($_POST['submit'])){
			$field = array("marca"=>$_POST['marca'],"modelo"=>$_POST['modelo'],"descripcion"=>$_POST['descripcion'],"precio"=>$_POST['precio'],"tipo"=>$_POST['tipo'],"niv"=>$_POST['niv'],"nro_motor"=>$_POST['nro_motor'],"nro_chasis"=>$_POST['nro_chasis']);
			$tbl = "auto";
			insert($tbl,$field);
	}
	?>
	<table border="1" width="100%">
		<tr>
			<th width="10%">Marca</th>
			<th width="10%">Modelo</th>
			<th width="20%">Descripcion</th>
			<th width="10%">Precio</th>
			<th width="10%">Tipo</th>
			<th width="10%">NIV</th>
			<th width="10%"># Motor</th>
			<th width="10%"># Chasis</th>
			<th width="10%">Opcion</th>
		</tr>
	<?php 
		$sql = "select * from auto";
		$result = db_query($sql);
		while($row = mysqli_fetch_object($result)){
		?>
		<tr>
			<td><?php echo $row->marca;?></td>
			<td><?php echo $row->modelo;?></td>
			<td><?php echo $row->descripcion;?></td>
			<td><?php echo $row->precio;?></td>
			<td><?php echo $row->tipo;?></td>
			<td><?php echo $row->niv;?></td>
			<td><?php echo $row->nro_motor;?></td>
			<td><?php echo $row->nro_chasis;?></td>
			<td>

	<a class="btn btn-primary" href="editar.php?ID_Auto=<?php echo $row->ID_Auto; ?>"><i class="fas fa-edit"></i></a>
	<a class="btn btn-primary" href="borrar.php?ID_Auto=<?php echo $row->ID_Auto;?>"><i class="fas fa-trash-alt"></i></a>
	</td>
		</tr>
		<?php } ?>
	</table>
	</div>
	<form action="generarReporteAutos.php" method="POST">
	      <center><input type="submit" name="imprimir" class="btn btn-primary" value="Imprimir"></center>        
    </form>
	
	

	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/efectos.js"></script>
	<script src="js/parallax.js"></script>
	</section>
	</body>

</html>