<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Herramienta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 900px; /* Aumentado el tamaño del formulario */
            margin-top: 40px;
            background-color: #ffffff;
            padding: 40px; /* Aumentado el padding */
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-left: auto; /* Centrado automático */
            margin-right: auto; /* Centrado automático */
        }
        h2 {
            text-align: center;
            color: #4caf50;
            margin-bottom: 30px;
            font-size: 3rem;
        }
        .form-label {
            color: #495057;
            font-size: 1.5rem; /* Aumentado el tamaño de la fuente */
            
        }
        .form-control {
            border-radius: 8px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            font-size: 1.5rem; /* Aumentado el tamaño de la fuente */
            padding: 12px; /* Aumentado el padding */
            height: 45px; /* Aumentado el alto de los campos */
        }
        button {
            width: 100%;
            border-radius: 8px;
            background-color: #4caf50;
            color: white;
            padding: 14px; /* Aumentado el padding */
            font-size: 1.3rem; /* Aumentado el tamaño de la fuente */
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
        a.btn-secondary {
            display: block;
            text-align: center;
            margin-top: 10px;
            border-radius: 8px;
            background-color: #6c757d;
            color: white;
            padding: 12px; /* Aumentado el padding */
            font-size: 1.2rem; /* Aumentado el tamaño de la fuente */
            text-decoration: none;
        }
        a.btn-secondary:hover {
            background-color: #5a6368;
        }
        .input-group-text {
            background-color: #4caf50;
            color: white;
            border-radius: 5px;
        }
        .mb-3 {
            position: relative;
        }
        .form-control:focus {
            box-shadow: 0 0 8px rgba(76, 175, 80, 0.5);
            border-color: #4caf50;
        }
        .btn, .form-control {
            transition: transform 0.2s ease;
        }
        .btn:hover, .form-control:hover {
            transform: translateY(-2px);
        }

        /* móvil */
        @media (max-width: 680px) {
            .tabla-herramientas tbody tr {
                padding: 5px;
            }
            .tabla-herramientas tbody tr td {
                padding: 5px;
                font-size: 14px;
            }
            .btn-ingresar {
                font-size: 16px;
                padding: 10px;
            }
            #formulario {
                width: 95%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registrar Herramienta</h2>
        <form action="obtener_datos.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Código</label>
                <input type="text" name="codigo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Herramienta</label>
                <input type="text" name="tipo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Cantidad</label>
                <input type="number" name="cantidad" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Estado</label>
                <input type="text" name="estado" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Observación</label>
                <input type="text" name="observacion" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Ubicación</label>
                <input type="text" name="ubicacion" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Registrar</button>
            <a href="menu.html" class="btn btn-secondary">Volver</a>
        </form>
    </div>
</body>
</html>
