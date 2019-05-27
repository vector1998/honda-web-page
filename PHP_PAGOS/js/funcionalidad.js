

function actualizarFacturas(cliente){
    $("#htmlCliente").val(cliente);
    console.log("actualizarFacturas con id: " + cliente);
    $.post('query.php', {"cliente":cliente}, function(result){
        json = JSON.parse(result);
        newhtml = "<option hidden disabled selected> </option>"
        for(i = 0; i < json.length; i++){
            newhtml += "<option value=\"" + json[i]["ID_Factura"] + "\">" + json[i]["ID_Factura"] + "</option>";
        }
        $("#Factura").html(newhtml);

    })
}

function armarTabla(val){
    idFactura = val;
    //console.log("idFactura encontrado: " + idFactura);
    $.post("query.php", {"factura":idFactura}, function(data){
        //console.log(data);
        json = JSON.parse(data);
        
        tabla = "<tr>"
            + "<th>Fecha</th>"
            + "<th>Abono</th>"
            + "<th>interes</th>"
            + "<th>mensualidad</th>"
            + "<th>estado</th>"
            +"<th>pagado</th>"
            + "</tr>";
        for(i = 0; i < json.length; i++){
            tabla += "<tr>"
                    +"<td>" + json[i]["fecha_pago"] + "</td>"
                    +"<td>" + json[i]["abono"] + "</td>"
                    +"<td>" + json[i]["interes"] + "</td>"
                    +"<td>" + json[i]["mensualidad"] + "</td>"
                    +"<td>" + json[i]["estado"] + "</td>" 
                    +'<td><a class="btn btn-primary" href="pagado.php?fecha_pago='+json[i]["fecha_pago"]+'&id='+idFactura+'"'+'><i class="fas fa-check-square"></i></a></td>'
                    +"</tr>"
        }

        $("#tabla").html(tabla);
        $("#htmlFactura").val(idFactura);
    });
    $.post("query.php", {"datosFactura":idFactura}, function(data){
        json = JSON.parse(data);
        console.log(json);
        for(i = 0; i < json.length; i++){
            $("#Vendedor").val(json[i]["Nombre"]);
            $("#Auto").val(json[i]["marca"]);
            $("#Modelo").val(json[i]["modelo"]);
            $("#Fecha").val(json[i]["fecha"]);
            $("#Plazos").val(json[i]["plazos"]);
        }
    });
}