<?php
//importar libreria para PDF
require __DIR__.'/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

$tabla_imprimir=$_POST['htmlTabla'];
$modelo="modelo: ".$_POST['htmlModelo']."<br>";
$auto="auto: ".$_POST['htmlAuto']."<br>";
$cliente="cliente: ".$_POST['htmlCliente']."<br>";
$porcentaje="porcentaje enganche:".$_POST['htmlPorcentajeEnganche']."<br>";
$tasa="tasa: ".$_POST['htmlTasa']."<br>";
$plazos="plazos: ".$_POST['htmlPlazos']."<br>";
$importe="importe: ".$_POST['htmlImporte']."<br>";
$saldo="saldo: ".$_POST['htmlSaldo']."<br><br><br>";


//generacion de código html para imagen
$imagen='<div align="center"><img src="img/logo_honda.png"></div><br><br>';

//obtener fecha del sistema
$time=time();
$fecha_creacion= date("Y-m-d ", $time);

//generacion de código html para fecha
$imprimirFecha="<br><br><label>Fecha: ".$fecha_creacion."
               </label> <br><br>";
//generar pdf

/* Instanciamos la clase HTML2PDF en un objeto, mediante el constructor. 
Le indicamos que ser? vertical, (P), en tam?o A4 y en espa?ol (es). */
$objetoPDF = new HTML2PDF('P', 'A4', 'es');
	
/* Colocamos el contenido del archivo html en el documento pdf. */
//$objetoPDF->WriteHTML($imagen);
$objetoPDF->WriteHTML($imagen.
                      $imprimirFecha.
                      $cliente.
                      $auto.
                      $modelo.
                      $porcentaje.
                      $tasa.
                      $importe.
                      $plazos.
                      $saldo.
                      $tabla_imprimir
                      );
        
/* Renderizamos el documento pdf y lo enviamos, directamente, al navegador. */
$objetoPDF->Output();
  
?>