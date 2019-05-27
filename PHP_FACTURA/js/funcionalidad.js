function actualizarModelo(val) {
    
    $.post('query.php', { 'marca': val }, function (data) {
        console.log(val);
        var jsonData = JSON.parse(data); // turn the data string into JSON
        var newHtml = "<option hidden disabled selected value>  </option>"; // Initialize the var outside of the .each function
        
        for(i = 0; i < jsonData.length; i++){
            newHtml += "<option value=\"" + jsonData[i]["ID_Auto"] + "\">" + jsonData[i]["modelo"] + "</option>";
        }
        $("#modelo").html(newHtml);
    });

}


function obtenerImporte(idAuto) {
    $.post('query.php', { 'importe': idAuto }, function (data) {
        console.log(idAuto);
        var jsonData = JSON.parse(data); // turn the data string into JSON
        var newHtml = ""; // Initialize the var outside of the .each function
        newHtml += jsonData[0]["precio"] ;
        $("#importe").val(newHtml);
    });

}

function calcularEnganche(enganche){
    importe = $("#importe").val()
    $("#importeEnganche").val( (enganche * importe / 100) )
}
