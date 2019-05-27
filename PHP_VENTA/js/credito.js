
var importe = 0;
var plazos = 0;
var fecha;
var porcentajeEnganche = 0;
var enganche = 0;
var tasaInteres = 0;
var saldo = 0;
var mensulaidadN = 0;
var mensualidadNeta = 0;
var listaSaldos = [];                //lista que almacena los saldos
var listaMensualidades = [];       //lista que almacena las mensualidades
var listaInteres = [];               //lista que almacena los intereses
var listaFechas = [];        //lista que almacena las fechas de los pagos
var listaPagos = [];       //lista que almacena los pagos
var listaAutos = ["jetta", "golf", "gol", "toureg", "jetta clasico"]; //lista que contiene autos
var listaPrecios = [200000, 150000, 115000, 750000, 100000];
var autos;
var autoSeleccionado = null;
var precioAuto;

function reiniciarValores(){
    importe = 0;
    plazos = 0;
    fecha;
    porcentajeEnganche = 0;
    enganche = 0;
    tasaInteres = 0;
    saldo = 0;
    mensulaidadN = 0;
    mensualidadNeta = 0;
    listaSaldos = [];                //lista que almacena los saldos
    listaMensualidades = [];       //lista que almacena las mensualidades
    listaInteres = [];               //lista que almacena los intereses
    listaFechas = [];        //lista que almacena las fechas de los pagos
    listaPagos = [];       //lista que almacena los pagos
    listaAutos = ["jetta", "golf", "gol", "toureg", "jetta clasico"]; //lista que contiene autos
    listaPrecios = [200000, 150000, 115000, 750000, 100000];
    autos;
    autoSeleccionado = null;
    precioAuto;
    modelo;

}

function obtenerDatos() {
    autos = document.getElementById('Autos');
    autoSeleccionado = listaAutos[autos.selectedIndex];
    precioAuto = listaPrecios[autos.selectedIndex];
    porcentajeEnganche = parseInt(document.getElementById('enganche').value) / 100;
    importe = $("#importe").val()//precioAuto;
    enganche = porcentajeEnganche * importe;
    fecha = String(document.getElementById('fecha').value);
    tasaInteres = parseFloat(document.getElementById('tasa').value) / 100;
    saldo = importe - enganche;
    plazos = document.getElementById('plazos').value;
    seleccion_modelo=document.getElementById('modelo');
    var modelo=seleccion_modelo.options[seleccion_modelo.selectedIndex].text;
    seleccion_vendedor=document.getElementById('Vendedor');
    var vendedor=seleccion_vendedor.options[seleccion_vendedor.selectedIndex].text;
    seleccion_cliente=document.getElementById('Cliente');
    var cliente=seleccion_cliente.options[seleccion_cliente.selectedIndex].text;
    $("#htmlAuto").val(autoSeleccionado);
    $("#htmlTasa").val(tasaInteres);
    $("#htmlModelo").val(modelo);
    $("#htmlPorcentajeEnganche").val(porcentajeEnganche);
    $("#htmlEnganche").val(enganche);
    $("#htmlImporte").val(importe);
    $("#htmlSaldo").val(saldo);
    $("#htmlPlazos").val(plazos);
    $("#htmlVendedor").val(vendedor);
    $("#htmlCliente").val(cliente);
    $("#htmlAuto").val($("#Autos").val());
    console.log(precioAuto);


}

function calcularMesualidades() {
    //calculo de mensualidad
    var saldoAux = saldo;          //variable que almacena las iteraciones del saldo
    var interes = 0;               //variable que almacena el interes
    mensualidadN = saldoAux / plazos;  //almacena la mensualidad sin interes
    for (let i = 0; i < plazos; i++) {
        listaSaldos.push(saldoAux);
        interes = saldoAux * tasaInteres;
        listaInteres.push(interes);
        mensualidadNeta = mensualidadN + interes;
        listaMensualidades.push(mensualidadNeta);
        saldoAux = saldoAux - mensualidadN;
    }
}

function calcularFechas() {
    var fechaAux = fecha;
    for (let i = 0; i < plazos; i++) {
        listaFechas.push(fecha);
        console.log(fecha = moment(fecha).add(30, 'days').format());
    }
}
function armarTabla() {
    listaPagos = [];
    for (let i = 0; i < plazos; i++) {
        iteracion = [];
        iteracion[0] = i + 1;
        iteracion[1] = listaFechas[i].split("T")[0];
        iteracion[2] = "abono Mensualidad";
        iteracion[3] = mensualidadN.toFixed(2);
        iteracion[4] = listaInteres[i].toFixed(2);
        iteracion[5] = listaMensualidades[i].toFixed(2);
        iteracion[6] = listaSaldos[i].toFixed(2);
        console.log(iteracion);
        listaPagos.push(iteracion);
    }
    //armarTablaHTML(listaPagos);
}

function armarTablaHTML() {
    var tablaHTML = document.getElementById("tabla");
    cadena = ""
    cadena += "<table cellspacing='10' style=\"width:100%;\">";
    cadena += `<tr > 
                    <th >Plazo</th>
                    <th >Fecha Pago</th>
                    <th >Concepto</th>
                    <th >Abono</th>
                    <th >Interes</th>
                    <th >Mensualidad</th>
                    <th >Saldo</th>
                </tr>`;
    for (renglon in listaPagos) {
        cadena += "<tr >";
        let reng = listaPagos[renglon];
        for (elemento in reng) {
            cadena += "<td >";
            cadena += `${reng[elemento]}`;
            cadena += "</td>\n";

        }
        cadena += "</tr>\n";
    }
    cadena += "</table>";
    console.log(cadena);
    $("#htmlTabla").val(cadena);
    tablaHTML.innerHTML = cadena;

}

function mandarDatos() {
    document.getElementById('importeEnganche').value = enganche;
    document.getElementById('saldo').value = saldo;
    document.getElementById('importe').value=importe;
}

function registrarVenta(){
    obj = {};
    obj["POST"] = true;
    obj["ID_Vendedor"] = $("#Vendedor").val();
    obj["ID_Auto"] = $("#modelo").val();
    obj["ID_Cliente"] = $("#Cliente").val();
    obj["plazos"] = plazos;
    obj["fecha"] = listaFechas[i].split("T")[0];
    obj["infoPagos"] = [];
    for(renglon in listaPagos){
        pago  = {};
        pago["fechaPago"] = listaPagos[renglon][1];
        pago["abono"] = listaPagos[renglon][3];
        pago["interes"] = listaPagos[renglon][4];
        pago["mensualidad"] = listaPagos[renglon][5];
        pago["saldo"] = listaPagos[renglon][6];
        obj["infoPagos"].push(pago);
    }

    $.post('insertar.php', obj, function(data){
        //json = JSON.parse(data);
        //notificar de la venta exitosa
        console.log("El resultado fue: " + data);
        if(data == 1){
            $("#mensajeVenta").show();
            $("#mensajeVenta").text("Venta Registrada Correctamente");
        }else{
            $("#mensajeVenta").show();
            $("#mensajeVenta").text("No se pudo actualizar");
        }
        setTimeout(function() {
            $("#mensajeVenta").hide();
          }, 1500);
    });
}

function calcularDatos() {
    reiniciarValores();
    obtenerDatos();
     calcularMesualidades();
     calcularFechas();
     armarTabla();
     armarTablaHTML();
     mandarDatos();
    //calcularFechas();
    registrarVenta();
}
