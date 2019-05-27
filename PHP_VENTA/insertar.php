<?php
include("function.php");
if (isset($_POST['POST'])) {
    insertarVenta();
}

function insertarVenta()
{
    error_log("Valores encontrados");
    error_log($_POST["POST"]);
    error_log($_POST["ID_Vendedor"]);
    error_log($_POST["ID_Auto"]);
    error_log($_POST["ID_Cliente"]);
    error_log($_POST["plazos"]);
    error_log($_POST["fecha"]);
    //Insertamos la factura
    $valores = array("ID_Vendedor" => $_POST["ID_Vendedor"], "ID_Cliente" => $_POST["ID_Cliente"], "ID_Auto" => $_POST["ID_Auto"], "plazos" => $_POST["plazos"], "fecha" => $_POST["fecha"]);
    $id_factura = insert("factura", $valores);

    $contador = 0;
    if ($id_factura != -1) {
        foreach ($_POST["infoPagos"] as $item) { //foreach element in $arr
            $contador++;
            error_log("------------------------------------------");
            error_log("Elemento pagos : " . $contador);
            error_log($item['fechaPago']); //etc
            error_log($item['abono']);
            error_log($item['interes']);
            error_log($item['mensualidad']);
            error_log($item['saldo']);
            //Insertamos el pago
            $infoPagos = array(
                "ID_Factura" => $id_factura, "fecha_pago" => $item["fechaPago"]
                , "abono" => $item["abono"], "interes" => $item["interes"]
                , "mensualidad" => $item["mensualidad"], "estado" => "N"
            );
            $id_pago = insert("infoPagos", $infoPagos);
            //Insertamos los datos adicionales de Pago
            $pago = array("ID_Pago" => $id_pago, "monto" => $item["mensualidad"], "saldo" => $item["saldo"]);
            insert('pago',$pago);
        }
        echo 1;
    }else{
        echo -1;
    }
}
