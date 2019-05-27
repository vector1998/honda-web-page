<?php
$server="localhost";
$user="root";
$password="";
$db="agencia";

//importar libreria para PDF
require __DIR__.'/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

//crear conexion
$connection=new mysqli($server,$user,$password,$db);

if($connection->connect_error){
  die("fallo en la conexion".$connection->connect_error);
}
//consulta
$query= "select fecha_pago,abono,interes,mensualidad,estado from infoPagos where ID_Factura = ".$_POST['htmlFactura'];

//leer de la base de datos
$datos =$connection->query($query);

$datos->data_seek(0);

$tabla="";

while ($fila =$datos->fetch_assoc()){  
      $tabla=$tabla."  
        <tr>  
          <td width='110'>".$fila['fecha_pago']."</td>    
          <td width='110'>".$fila['abono']."</td>  
          <td width='110'>".$fila['interes']."</td>  
          <td width='110'>".$fila['mensualidad']."</td>  
          <td width='110'>".$fila['estado']."</td>   
        </tr>  
    ";
}

//imprimir tabla
$tablaImprimir="
      <br><br>
      <table border='1'>
        <tr>
          <th>Fecha</th>
          <th>Abono</th>
          <th>Interes</th>
          <th>Mensualidad</th>
          <th>Estado</th>
        </tr>
        ".$tabla."</table>";

//obtención del CURP del cliente
$query="select curp from cliente where ID_cliente=".$_POST['htmlCliente'];

$datos=$connection->query($query);

$datos->data_seek(0);

$resultado=$datos->fetch_row();

$cliente=$resultado[0];

//obtencion de fecha de la factura
$query="select fecha, ID_Vendedor from factura where ID_Factura=".$_POST['htmlFactura'];

$datos=$connection->query($query);

$datos->data_seek(0);

$resultado=$datos->fetch_row();

$fecha_factura=$resultado[0];

$htmlFechaFactura="<label>Fecha de compra:".$fecha_factura."</label>";

$id_vendedor=$resultado[1];

//obtención del nombre del vendedor
$query="select Nombre from vendedor where ID_vendedor=".$id_vendedor;

$datos=$connection->query($query);

$datos->data_seek(0);

$resultado=$datos->fetch_row();

$vendedor=$resultado[0];

$htmlVendedor="<label>Nombre del vendedor: ".$vendedor."</label><br><br>";

$titulo='<br><br><div align="center"><font size="20">Lista de Pagos</font></div>';
//generacion de código html para imagen
$imagen='<div align="center"><img src="img/logo_honda.png"></div>';

//obtener fecha del sistema
$time=time();
$fecha_creacion= date("Y-m-d ", $time);

//generacion de código html para fecha
$imprimirFecha="<br><br><label>Fecha impresion: ".$fecha_creacion."
               </label> <br><br>";
//factura
$factura="<label>ID_Factura:".$_POST['htmlFactura']."</label><br><br>";

//nombre del cliente
$htmlCliente="<br><br><label>Cliente:".$cliente."</label><br><br>"; 
//generar pdf

/* Instanciamos la clase HTML2PDF en un objeto, mediante el constructor. 
	Le indicamos que ser� vertical, (P), en tam�o A4 y en espa�ol (es). */
$objetoPDF = new HTML2PDF('P', 'A4', 'es');
	
/* Colocamos el contenido del archivo html en el documento pdf. */
//$objetoPDF->WriteHTML($imagen);
$objetoPDF->WriteHTML($imagen.
                      $imprimirFecha.
                      $factura.
                      $htmlFechaFactura.
                      $htmlCliente.
                      $htmlVendedor.
                      $titulo.
                      $tablaImprimir);
	
/* Renderizamos el documento pdf y lo enviamos, directamente, al navegador. */
$objetoPDF->Output();

//cerrar conexion
$connection->close();
?>