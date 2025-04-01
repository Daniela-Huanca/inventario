<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST["codigo"];
    $tipo = $_POST["tipo"];
    $cantidad = $_POST["cantidad"];
    $estado = $_POST["estado"];
    $observacion = $_POST["observacion"];
    $ubicacion = $_POST["ubicacion"];

    $sql = "INSERT INTO herramientas (codigo, tipo, cantidad, estado, observacion, ubicacion, fecha) 
            VALUES ('$codigo', '$tipo', '$cantidad', '$estado', '$observacion', '$ubicacion', NOW())";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
