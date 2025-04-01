<?php
$host = "localhost";
$usuario = "root";  // Cambiar si tienes otro usuario
$password = "";     // Agregar contraseña si la base de datos la tiene
$base_datos = "registro";

$conn = new mysqli($host, $usuario, $password, $base_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
