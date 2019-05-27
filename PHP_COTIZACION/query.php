<?php
include("function.php");
if (isset($_POST['marca'])) {
    obtenerModelo();
}else if(isset($_POST['importe'])){
   obtenerImporte();
}

function obtenerModelo(){
    $marca=$_POST['marca'];
    $sql="select ID_Auto,modelo from auto where marca='$marca'";
    $result = db_query($sql);
    $data = []; // Save the data into an arbitrary array.
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

function obtenerImporte(){
    $sql = "select precio 
    from auto 
    where ID_Auto =" . $_POST['importe'];
    $result = db_query($sql);
    $data = []; // Save the data into an arbitrary array.
    while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
    }
    echo json_encode($data);

}

