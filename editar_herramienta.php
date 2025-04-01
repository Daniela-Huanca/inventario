<?php
// Conexión a la base de datos
include 'conexion.php';

// Verificar si se recibió un ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener datos de la herramienta
    $query = "SELECT * FROM herramientas WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $herramienta = $resultado->fetch_assoc();
    } else {
        echo "Herramienta no encontrada.";
        exit();
    }
} else {
    echo "ID no proporcionado.";
    exit();
}

// Si el formulario es enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo = $_POST['codigo'];
    $tipo = $_POST['tipo'];
    $cantidad = $_POST['cantidad'];
    $estado = $_POST['estado'];
    $observacion = $_POST['observacion'];
    $ubicacion = $_POST['ubicacion'];
    $fecha = $_POST['fecha'];

    // Actualizar la herramienta
    $query = "UPDATE herramientas SET codigo=?, tipo=?, cantidad=?, estado=?, observacion=?, ubicacion=?, fecha=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssissssi", $codigo, $tipo, $cantidad, $estado, $observacion, $ubicacion, $fecha, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Herramienta actualizada correctamente'); window.location='index.php';</script>";
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Herramienta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Editar Herramienta</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Código</label>
                <input type="text" name="codigo" class="form-control" value="<?= $herramienta['codigo'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label"></label>
                <input type="text" name="tipo" class="form-control" value="<?= $herramienta['tipo'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Cantidad</label>
                <input type="number" name="cantidad" class="form-control" value="<?= $herramienta['cantidad'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Estado</label>
                <input type="text" name="estado" class="form-control" value="<?= $herramienta['estado'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Observación</label>
                <input type="text" name="observacion" class="form-control" value="<?= $herramienta['observacion'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Ubicación</label>
                <input type="text" name="ubicacion" class="form-control" value="<?= $herramienta['ubicacion'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha</label>
                <input type="date" name="fecha" class="form-control" value="<?= date('Y-m-d', strtotime($herramienta['fecha'])) ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
