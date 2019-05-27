<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no,
		initial-scale=1.0,maximium-scale=1.0,minimum-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,600,700">
    <link rel="stylesheet" href="css/efectos2.css">
    <title>Cotización</title>
    <link type="text/css" href="bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 4px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }

        th {
            background-color: #000;
            color: #fb2626;
        }

        .main-wrapper {
            width: 60%;
            background: #E0E4E5;
            border: 1px solid #292929;
            padding: 25px;
            margin: auto;
        }

        hr {
            margin-top: 5px;
            margin-bottom: 5px;
            border: 0;
            border-top: 1px solid #eee;
        }

        h1 {
            font-size: 24px;
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
            <h1>Cotización</h1>
            <br><br>
            <form action="index.php" method="post">
                <div class="col-xs-3">
                    <label>Cliente</label>
                    <select class="form-control" id="Cliente">
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
                    <?php
                    $sql = "select marca from auto group by marca";
                    $result = db_query($sql);
                    ?>
                    <label>Auto</label>
                    <select class="form-control" id="Autos" value="" onchange="actualizarModelo(this.value)">
                        <option hidden disabled selected value> </option>
                        <?php

                        while ($row = mysqli_fetch_object($result)) {
                            ?>
                            <option value="<?php echo $row->marca; ?>"><?php echo $row->marca; ?></option>

                        <?php } ?>
                    </select>
                </div>
                <div class="col-xs-3">
                    <label>Modelo</label>
                    <select class="form-control" id="modelo" onchange=obtenerImporte(this.value)></select>
                </div>
                <div class=" col-xs-3">
                    <label>Fecha</label>
                    <input class="form-control" type="date" id="fecha" name="fecha">
                    <br><br>
                </div>
                <div class="col-xs-3">
                    <label>Importe</label>
                    <input class="form-control" id="importe" name="importe" type="text" placeholder="Importe" readonly>
                </div>
                <div class=" col-xs-3">
                    <label>Enganche</label>
                    <input class="form-control" id="enganche" name="Enganche" type="text" placeholder="Enganche" onkeyup="calcularEnganche(this.value)">
                </div>
                <div class=" col-xs-3">
                    <label>Importe Enganche</label>
                    <input class="form-control" id="importeEnganche" name="importeEnganche" type="text" placeholder="Importe Enganche" readonly>
                </div>
                <div class="col-xs-3">
                    <label>Tasa</label>
                    <input class="form-control" id="tasa" name="tasa" type="text" placeholder="Tasa" ">
            <br><br>
        </div> 
        <div class=" col-xs-3">
                    <label>Plazos</label>
                    <input class="form-control" id="plazos" name="plazos" type="text" placeholder="Plazos" ">
		</div> 
        <div class=" col-xs-3">
                    <label>Saldo</label>
                    <input class="form-control" id="saldo" name="Saldo" type="text" placeholder="Saldo" readonly>
                </div>
                <br><br><br>
                <label></label>
                <br><br>
                <input class="btn btn-primary" type="button" id="calcular" onclick="calcularDatos()" name="submit" value="calcular">
                <br>
            </form>
            <br>

            <!-- Tabla a poblar con la cotización-->
            <table id="tabla" cellspacing='20' name="tabla" border="1" width="100%">
                <!--tr>
                    <th>Plazo</th>
                    <th>Fecha Pago</th>
                    <th>Concepto</th>
                    <th>Abono</th>
                    <th>Interes</th>
                    <th>Mensualidad</th>
                    <th>Saldo</th>
                </tr-->
                <?php
                /*if (
                    isset($_POST["fecha"]) && isset($_POST["importe"]) && isset($_POST["importeEnganche"])
                    && isset($_POST["tasa"]) && isset($_POST["plazos"])
                ) {
                    $saldo = $_POST["importe"] - $_POST["importeEnganche"];
                    $mensualidad = $saldo / $_POST["plazos"];
                    $interes = 0.0;
                    for ($i = 0; $i < $_POST["plazos"]; $i++) {
                        $interes = $saldo * $_POST["tasa"];
                        ?>
                        <tr>
                            <td>
                                <?php echo $i ?>
                            </td>
                            <td>POR DEFINIR</td>
                            <td>Mensualidad</td>
                            <td>
                                <?php echo $mensualidad ?>
                            </td>
                            <td>
                                <?php echo $interes ?>
                            </td>
                            <td>
                                <?php echo ($interes + $mensualidad) ?>
                            </td>
                            <td>
                                <?php echo $saldo ?>
                            </td>
                        </tr>
                        <?php
                        $saldo -= $mensualidad;
                    }
                }
                if (isset($_POST['submit'])) {
                    print_r( $_POST);
                }
                */?>
            </table>
        </div>
        <form action="generarCotizacion.php" method="POST">
        <input type ="text" id="htmlTabla" name="htmlTabla" value="" hidden="true">
        <input type ="text" id="htmlCliente" name="htmlCliente" value="" hidden="true">
        <input type ="text" id="htmlAuto" name="htmlAuto" value="" hidden="true">
        <input type ="text" id="htmlModelo" name="htmlModelo" value="" hidden="true">
        <input type ="text" id="htmlPorcentajeEnganche" name="htmlPorcentajeEnganche" value="" hidden="true">
        <input type ="text" id="htmlTasa" name="htmlTasa" value="" hidden="true">
        <input type ="text" id="htmlPlazos" name="htmlPlazos" value="" hidden="true">
        <input type ="text" id="htmlSaldo" name="htmlSaldo" value="" hidden="true">
        <input type ="text" id="htmlImporte" name="htmlImporte" value="" hidden="true">
        <center><input type="submit" name="imprimir" class="btn btn-primary" value="Imprimir"></center>
        </form>
       
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/efectos.js"></script>
        <script src="js/parallax.js"></script>
        <script src="js/moment.js"></script>
        <script src="js/credito.js"></script>
        <script src="js/funcionalidad.js"></script>

    </section>
</body>

</html>