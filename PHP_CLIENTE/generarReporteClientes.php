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
$query="SELECT*FROM cliente";

//leer de la base de datos
$datos =$connection->query($query);

$datos->data_seek(0);

$tabla="";

while ($fila =$datos->fetch_assoc()){  
      $tabla=$tabla."  
        <tr>  
          <td width='150'>".$fila['ID_cliente']."</td>  
          <td width='150'>".$fila['nombre']."</td>  
          <td width='150'>".$fila['rfc']."</td>  
          <td width='150'>".$fila['domicilio']."</td>   
        </tr>  
    ";
}

//imprimir tabla
$tablaImprimir='
      <br><br>
      <table cellspacing="10">
        <tr>
          <th>ID_Cliente</th>
          <th>nombre</th>
          <th>rfc</th>
          <th>domicilio</th>
        </tr>
        '.$tabla.'</table>';

$titulo='<br><br><div align="center"><font size="20">Lista de clientes</font></div>';
//generacion de c�digo html para imagen
$imagen='<div align="center"><img src="img/logo_honda.png"></div>';

//obtener fecha del sistema
$time=time();
$fecha_creacion= date("Y-m-d ", $time);

//generacion de c�digo html para fecha
$imprimirFecha="<br><br><label>Fecha: ".$fecha_creacion."
               </label> <br><br>";
//generar pdf

/* Instanciamos la clase HTML2PDF en un objeto, mediante el constructor. 
	Le indicamos que ser? vertical, (P), en tam?o A4 y en espa?ol (es). */
$objetoPDF = new HTML2PDF('P', 'A4', 'es');
	
/* Colocamos el contenido del archivo html en el documento pdf. */
//$objetoPDF->WriteHTML($imagen);
$objetoPDF->WriteHTML($imagen.$imprimirFecha.$titulo.$tablaImprimir);
	
/* Renderizamos el documento pdf y lo enviamos, directamente, al navegador. */
$objetoPDF->Output();

//cerrar conexion
$connection->close();
?>