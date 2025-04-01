<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Herramientas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Estilo para centrar el formulario */
        .modal-dialog {
            max-width: 500px;
            margin: 100px auto;
        }

        /* Modal de éxito con un estilo más como una ventana de Windows */
        #modalExito {
            display: none;
            background-color: #eafaf1;
            border: 2px solidrgb(12, 120, 16);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translateX(-50%);
            animation: fadeIn 1s ease-out;
        }

        #modalExito .modal-header {
            background-color:rgb(114, 155, 115);
            color: white;
            font-size: 18px;
            border-bottom: 2px solid #ddd;
        }

        #modalExito .modal-body {
            text-align: center;
            font-size: 16px;
            padding: 20px;
        }

        #modalExito .modal-footer {
            border-top: 2px solid #ddd;
            text-align: center;
        }

        .modal-body i {
            font-size: 3rem;
            color: #4CAF50;
        }

        .btn-close {
            background-color: transparent;
            border: none;
        }

        /* Estilo para el modal de confirmación */
        #modalConfirmar {
            display: none;
        }

        .table {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background-color:rgb(108, 181, 126);
            color: white;
        }

        .table td {
            color:rgb(16, 62, 107);
        }

        .btn {
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn:hover {
            background-color: #28a745;
            transform: scale(1.05);
        }

        .btn-danger:hover {
            background-color:rgba(234, 67, 16, 0.84);
        }

        .btn-warning:hover {
            background-color:rgb(255, 247, 4);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .btn-volver {
            position: absolute;
            top: 63px;
            right: -5px;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 10px;
            z-index: 9999;
        }

        .btn-volver:hover {
            background-color: #45a049;
        }

        /* Estilos para el botón y tabla de datos */
        #tablaDatos {
            display: none;
        }

        #tablaDatos.show {
            display: block;
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
    <script>
        // Función para mostrar los datos de la herramienta
        function toggleDatos(id) {
            var datos = document.getElementById('detalle_' + id);
            if (datos.style.display === 'none' || datos.style.display === '') {
                datos.style.display = 'table-row';
            } else {
                datos.style.display = 'none';
            }
        }

        // Función para mostrar el modal de confirmación de eliminación
        function confirmarEliminacion(id) {
            document.getElementById('modalConfirmar').style.display = 'block';
            document.getElementById('idHerramienta').value = id;
        }

        // Función para cerrar el modal
        function cerrarModal() {
            document.getElementById('modalConfirmar').style.display = 'none';
        }

        // Función para eliminar la herramienta
        function eliminarHerramienta() {
            var id = document.getElementById('idHerramienta').value;
            window.location.href = "eliminar_herramienta.php?id=" + id; // Redirige para eliminar
            setTimeout(function() {
                document.getElementById('modalExito').style.display = 'block'; // Muestra el modal de éxito
            }, 500); // Retraso para simular proceso de eliminación
        }

        // Función para mostrar el modal de modificación exitosa
        function mostrarExitoModificacion() {
            setTimeout(function() {
                document.getElementById('modalExito').style.display = 'block'; // Muestra el modal de éxito
            }, 500); // Retraso para simular proceso de modificación
        }

        // Función para cerrar el modal de éxito
        function cerrarModalExito() {
            document.getElementById('modalExito').style.display = 'none';
        }
    </script>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center text-primary">Gestión de Herramientas</h2>
        <a href="registro_herramienta.php" class="btn btn-primary mb-3">Registrar Nueva Herramienta</a>
        <a href="menu.html" class="btn-volver">Volver</a>

        <!-- Formulario de búsqueda -->
        <form method="GET" action="">
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="buscar" placeholder="Buscar herramienta por nombre" value="<?php echo isset($_GET['buscar']) ? $_GET['buscar'] : ''; ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success">Buscar</button>
                </div>
            </div>
        </form>

        <!-- Datos de las herramientas que se desplazan hacia abajo -->
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>CÓDIGO</th>
                    <th>HERRAMIENTA</th>
                    <th>VER</th>
                </tr>
            </thead>
            <tbody id="tablaHerramientas">
                <?php
                // Obtener el término de búsqueda
                $buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';

                // Modificar la consulta para filtrar por nombre de herramienta
                $sql = "SELECT * FROM herramientas WHERE tipo LIKE '%$buscar%'";

                $resultado = $conn->query($sql);

                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr>
                            <td>{$fila['codigo']}</td>
                            <td>{$fila['tipo']}</td>
                            <td><button class='btn btn-info' onclick='toggleDatos({$fila['id']})'>Ver</button></td>
                        </tr>
                        <tr id='detalle_{$fila['id']}' style='display:none;'>
                            <td colspan='3'>
                                <table class='table table-bordered'>
                                    <tr>
                                        <th>CANTIDAD</th>
                                        <td>{$fila['cantidad']}</td>
                                    </tr>
                                    <tr>
                                        <th>ESTADO</th>
                                        <td>{$fila['estado']}</td>
                                    </tr>
                                    <tr>
                                        <th>OBSERVACIÓN</th>
                                        <td>{$fila['observacion']}</td>
                                    </tr>
                                    <tr>
                                        <th>UBICACIÓN</th>
                                        <td>{$fila['ubicacion']}</td>
                                    </tr>
                                    <tr>
                                        <th>FECHA DE REGISTRO</th>
                                        <td>{$fila['fecha']}</td>
                                    </tr>
                                    <tr>
                                        <td colspan='2'>
                                            <a href='editar_herramienta.php?id={$fila['id']}' class='btn btn-warning' onclick='mostrarExitoModificacion()'>Editar</a>
                                            <a href='javascript:confirmarEliminacion({$fila['id']})' class='btn btn-danger'>Eliminar</a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>No se encontraron herramientas.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal de confirmación de eliminación -->
    <div id="modalConfirmar" class="modal" style="display:none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar eliminación</h5>
                    <button type="button" class="btn-close" onclick="cerrarModal()"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar esta herramienta?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="eliminarHerramienta()">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de éxito con estilo de ventana emergente de Windows -->
    <div id="modalExito" class="modal">
        <div class="modal-dialog">
            <div class="modal-content" id="modalExito">
                <div class="modal-header">
                    <h5 class="modal-title">¡Modificación Exitosa!</h5>
                    <button type="button" class="btn-close" onclick="cerrarModalExito()"></button>
                </div>
                <div class="modal-body">
                    <i class="fas fa-check-circle"></i>
                    <p>La herramienta ha sido modificada correctamente.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="cerrarModalExito()">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="idHerramienta" value="">
</body>
</html>
