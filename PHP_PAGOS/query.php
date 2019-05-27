<?php
include('function.php');
if(isset($_POST["cliente"])){
    consultarFacturas();
}else if(isset($_POST["factura"])){
    consultarPagos();
}else if(isset($_POST["datosFactura"])){
    consultarDatosFacturas();
}

function consultarFacturas(){
    $sql = "select ID_Factura from factura where ID_Cliente = " . $_POST["cliente"];
    $result = db_query($sql);
    responderJson($result);
}

function consultarPagos(){
    $sql = "select fecha_pago,abono,interes,mensualidad,estado from infoPagos where ID_Factura = " . $_POST["factura"];
    $result = db_query($sql);
    responderJson($result);
}

function consultarDatosFacturas(){
    $sql = "select vendedor.Nombre, auto.marca, auto.modelo, factura.fecha, factura.plazos 
            from factura 
            inner join vendedor on factura.ID_Vendedor=vendedor.ID_Vendedor 
            inner join auto on factura.ID_Auto=auto.ID_Auto 
            where factura.ID_Factura=".$_POST["datosFactura"];
    responderJson(db_query($sql));

}

function responderJson($result){
    $data = []; // Save the data into an arbitrary array.
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
}


?>