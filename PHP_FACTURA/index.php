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
				<a onClick="window.location.href='http://localhost/PHP_AUTOS/index.php'" ,id="btn-acerca-de">Autos</a>
				<a onClick="window.location.href='http://localhost/PHP_CLIENTE/index.php'" ,id="btn-menu">Clientes</a>
				<a onClick="window.location.href='http://localhost/PHP_VENDEDOR/index.php'" ,id="btn-galeria">Vendedores</a>
				<a onClick="window.location.href='http://localhost/PHP_COTIZACION/index.php'" ,id="btn-galeria">Cotización</a>
				<a onClick="window.location.href='http://localhost/PHP_FACTURA/index.php'" ,id="btn-galeria">Factura</a>
				<a onClick="window.location.href='http://localhost/PHP_VENTA/index.php'" ,id="btn-galeria">Venta</a>
				<a onClick="window.location.href='http://localhost/PHP_PAGOS'" ,id="btn-galeria">Cobranza</a>
			</nav>
		</div>
	</header>
	<body>
		<section class="main">
		<br><br>
	<div class="main-wrapper">
	<h1>Facturas</h1>
	<br><br>
	
	<br>

	<table border="1" width="100%">
		<tr>
			<th width="20%">Nombre Cliente</th>
			<th width="10%">CURP</th>
			<th width="10%">Marca</th>
			<th width="10%">Modelo</th>
			<th width="15%">Fecha</th>
			<th width="5%">Plazos</th>
			<th width="15%">Vendedor</th>
			<th width="10%">Opcion</th>
		</tr>
    <?php 
        include('function.php');
		$sql = "select factura.ID_Factura, vendedor.Nombre as vNombre, cliente.nombre as cNombre, cliente.curp, auto.marca, auto.modelo, factura.fecha, factura.plazos 
                from factura 
                inner join vendedor on factura.ID_Vendedor=vendedor.ID_Vendedor 
                inner join auto on factura.ID_Auto=auto.ID_Auto 
                inner join cliente on factura.ID_Cliente=cliente.ID_cliente";
		$result = db_query($sql);
		while($row = mysqli_fetch_object($result)){
		?>
		<tr>
			<td><?php echo $row->cNombre;?></td>
			<td><?php echo $row->curp;?></td>
			<td><?php echo $row->marca;?></td>
			<td><?php echo $row->modelo;?></td>
			<td><?php echo $row->fecha;?></td>
			<td><?php echo $row->plazos;?></td>
			<td><?php echo $row->vNombre;?></td>
			<td>

	<a class="btn btn-primary" href="borrar.php?ID_Factura=<?php echo $row->ID_Factura;?>"><i class="fas fa-trash-alt"></i></a>
	</td>
		</tr>
		<?php } ?>
	</table>
	</div>
	<form action="generarReporteFactura.php">
	<center><input type="submit" name="imprimir" class="btn btn-primary" value="Imprimir"></center>
    </form>
	<?php
		include("fpdf.php");
	?>

	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/efectos.js"></script>
	<script src="js/parallax.js"></script>
	</section>
	</body>

</html>