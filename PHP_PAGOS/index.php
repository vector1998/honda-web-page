<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no,
		initial-scale=1.0,maximium-scale=1.0,minimum-scale=1.0">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,600,700">
		<link rel="stylesheet" href="css/efectos2.css">
		<title>Pagos</title>
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
	<h1>Registro de Pagos</h1>
	<br><br>
	<form action="" method="post">
		<div class="col-xs-3">
			<label>Cliente</label>
			<select class="form-control" id="Cliente" value="" onchange="actualizarFacturas(this.value)">
                        <option hidden disabled selected value> </option>
                        <?php
                        include("function.php");
                        $sql = "select ID_Cliente,curp from cliente";
                        $result = db_query($sql);
                        while ($row = mysqli_fetch_object($result)) {
                            ?>
                            <option value="<?php echo $row->ID_Cliente; ?>"><?php echo $row->curp; ?></option>

                        <?php } ?>
                    </select>
		</div>
		<div class="col-xs-3">
			<label>Factura</label>
            <select class="form-control" id="Factura" onchange="armarTabla(this.value)">
                        
            </select>
		</div>  
		<div class="col-xs-3">
			<label>Vendedor</label>
	    	<input class="form-control" id="Vendedor" name="rfc" type="text" disabled>
        </div> 
        <div class="col-xs-3">
			<label>Auto</label>
	    	<input class="form-control" id="Auto" name="rfc" type="text" disabled>
        </div> 
        <div class="col-xs-3">
			<label>Modelo</label>
	    	<input class="form-control" id="Modelo" name="rfc" type="text" disabled>
        </div>
        <div class="col-xs-3">
			<label>Fecha</label>
	    	<input class="form-control" id="Fecha" name="rfc" type="text" disabled>
        </div> 
        <div class="col-xs-3">
			<label>Plazos</label>
	    	<input class="form-control" id="Plazos" name="rfc" type="text" disabled>
        </div> 
		<br><br><br>
		<label></label>
		<br><br>  
			<br>
	</form>
	<br>

	
	<table border="1" width="100%" id="tabla">	</table>
	</div>
	<form action='generarReportePagos.php' method="POST">
	<input type ="text" id="htmlCliente" name="htmlCliente" value="" hidden="true">
	<input type ="text" id="htmlFactura" name="htmlFactura" value="" hidden="true">
	<center><input type="submit" name="imprimir" class="btn btn-primary" value="Imprimir"></center>
    </form>
	<?php
		include("fpdf.php");
	?>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/efectos.js"></script>
    <script src="js/parallax.js"></script>
    <script src="js/funcionalidad.js"></script>
	</section>
	</body>
</html>