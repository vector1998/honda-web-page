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
$query=	$sql = "select factura.ID_Factura, vendedor.Nombre as vNombre, cliente.nombre as cNombre, cliente.curp, auto.marca, auto.modelo, factura.fecha, factura.plazos 
               from factura 
               inner join vendedor on factura.ID_Vendedor=vendedor.ID_Vendedor 
               inner join auto on factura.ID_Auto=auto.ID_Auto 
               inner join cliente on factura.ID_Cliente=cliente.ID_cliente";;

//leer de la base de datos
$datos =$connection->query($query);

$datos->data_seek(0);

$tabla="";

while ($fila =$datos->fetch_assoc()){  
      $tabla=$tabla."  
        <tr>  
          <td width='110'>".$fila['cNombre']."</td>    
          <td width='110'>".$fila['marca']."</td>  
          <td width='110'>".$fila["modelo"]."</td>  
          <td width='110'>".$fila['fecha']."</td>  
          <td width='110'>".$fila['plazos']."</td>  
          <td width='110'>".$fila['vNombre']."</td> 
        </tr>  
    ";
}

//imprimir tabla
$tablaImprimir="
      <br><br>
      <table border='1'>
        <tr>
          <th>cliente</th>
          <th>Marca</th>
          <th>Modelo</th>
          <th>Fecha</th>
          <th>plazos</th>
          <th>Vendedor</th>
        </tr>
        ".$tabla."</table>";

$titulo='<br><br><div align="center"><font size="20">Lista de Facturas</font></div>';
//generacion de código html para imagen
$imagen='<div align="center"><img src="img/logo_honda.png"></div>';

//obtener fecha del sistema
$time=time();
$fecha_creacion= date("Y-m-d ", $time);

//generacion de código html para fecha
$imprimirFecha="<br><br><label>Fecha: ".$fecha_creacion."
               </label> <br><br>";
//generar pdf

/* Instanciamos la clase HTML2PDF en un objeto, mediante el constructor. 
	Le indicamos que ser� vertical, (P), en tam�o A4 y en espa�ol (es). */
$objetoPDF = new HTML2PDF('P', 'A4', 'es');
	
/* Colocamos el contenido del archivo html en el documento pdf. */
//$objetoPDF->WriteHTML($imagen);
$objetoPDF->WriteHTML($imagen.$imprimirFecha.$titulo.$tablaImprimir);
	
/* Renderizamos el documento pdf y lo enviamos, directamente, al navegador. */
$objetoPDF->Output();

//cerrar conexion
$connection->close();
?>