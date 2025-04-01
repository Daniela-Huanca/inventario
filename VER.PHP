<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Herramientas</title>
    <link rel="stylesheet" href="Styles/style.css">
    <link rel="stylesheet" href="Styles/normalize.css">

</head>
<body>
    
  
    
    <div class="container mt-4">
        <h2 class="text-center text-primary">GESTIÓN DE HERRAMIENTAS</h2>
        <table class="tabla-herramientas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CÓDIGO</th>
                    <th>HERRAMIENTA</th>
                    <th>CANTIDAD</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT * FROM herramientas";
                $resultado = $conn->query($sql);

                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        $id = $fila['id'];
                        echo "<tr>
                            <td>{$fila['id']}</td>
                            <td>{$fila['codigo']}</td>
                            <td>{$fila['tipo']}</td>
                            <td>{$fila['cantidad']}</td>
                            <td>
                                <button id='estado_$id' class='estado libre' onclick='confirmarCambioEstado($id)'>Libre</button>
                                <button class='ver-usuario' onclick='mostrarUsuario($id)'>Ver Quién lo Usa</button>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No se encontraron herramientas.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="modalConfirmacion" class="modal-custom">
        <p id="mensajeConfirmacion"></p>
        <button id="btnSi" class="btn btn-success">Sí</button>
        <button onclick="cerrarModal()" class="btn btn-danger">Cancelar</button>
    </div>

    <div id="modalUsuario" class="modal-custom">
        <p id="mensajeUsuario"></p>
        <button onclick="cerrarModal()" class="btn btn-secondary">Cerrar</button>
    </div>

    <div id="formulario" class="bg-light p-4 rounded">
        <h3 class="text-center text-primary">Registro de Herramienta</h3>
        <label for="nombreUsuario">Nombre del Usuario:</label> <BR>
        <input type="text" id="nombreUsuario" class="form-control" required>
        <label for="fechaHora">Fecha y Hora:</label>
        <input type="datetime-local" id="fechaHora" class="form-control" required>
        <div class="text-center">
            <button onclick="guardarRegistro()" class="btn btn-primary mt-3">Guardar</button>
            <button onclick="cerrarFormulario()" class="btn btn-secondary mt-3">Cancelar</button>
        </div>
    </div>
 
    <div class="busqueda">
    <input type="text" id="buscarHerramienta" placeholder="Buscar herramienta..." onkeyup="filtrarHerramientas()">
</div>






    <script>
       
    function filtrarHerramientas() {
        let input = document.getElementById("buscarHerramienta").value.toLowerCase();
        let filas = document.querySelectorAll(".tabla-herramientas tbody tr");

        filas.forEach(fila => {
            let textoFila = fila.innerText.toLowerCase();
            fila.style.display = textoFila.includes(input) ? "" : "none";
        });
    }


        let herramientaSeleccionada = null;
        let estadoBtnSeleccionado = null;

        function confirmarCambioEstado(id) {
            herramientaSeleccionada = id;
            estadoBtnSeleccionado = document.getElementById(`estado_${id}`);
            let mensaje = estadoBtnSeleccionado.classList.contains("libre") ? 
                "¿Seguro que desea poner en uso esta herramienta?" : 
                "¿Seguro que desea dejarla libre?";
            document.getElementById("mensajeConfirmacion").textContent = mensaje;
            document.getElementById("modalConfirmacion").style.display = "block";
            document.getElementById("btnSi").onclick = cambiarEstado;
        }

        function cambiarEstado() {
            if (estadoBtnSeleccionado.classList.contains("libre")) {
                estadoBtnSeleccionado.textContent = "En uso";
                estadoBtnSeleccionado.classList.remove("libre");
                estadoBtnSeleccionado.classList.add("ocupado");
                document.getElementById("formulario").style.display = "block"; // Mostrar formulario
            } else {
                estadoBtnSeleccionado.textContent = "Libre";
                estadoBtnSeleccionado.classList.remove("ocupado");
                estadoBtnSeleccionado.classList.add("libre");
            }
            cerrarModal();
        }

        function mostrarUsuario(id) {
            let usuario = localStorage.getItem(`usuario_${id}`);
            let fecha = localStorage.getItem(`fecha_${id}`);
            let mensaje = usuario && fecha ? 
                `Actualmente en uso por: ${usuario} - Fecha: ${fecha}` : 
                "La herramienta está libre.";
            document.getElementById("mensajeUsuario").textContent = mensaje;
            document.getElementById("modalUsuario").style.display = "block";
        }

        function cerrarModal() {
            document.getElementById("modalConfirmacion").style.display = "none";
            document.getElementById("modalUsuario").style.display = "none";
        }

        function cerrarFormulario() {
            document.getElementById("formulario").style.display = "none";
        }

        function guardarRegistro() {
            let nombre = document.getElementById("nombreUsuario").value;
            let fechaHora = document.getElementById("fechaHora").value;
            if (nombre === "" || fechaHora === "") {
                alert("Por favor, completa todos los campos.");
                return;
            }
            localStorage.setItem(`usuario_${herramientaSeleccionada}`, nombre);
            localStorage.setItem(`fecha_${herramientaSeleccionada}`, fechaHora);
            let estadoBtn = document.getElementById(`estado_${herramientaSeleccionada}`);
            estadoBtn.textContent = "En uso";
            estadoBtn.classList.remove("libre");
            estadoBtn.classList.add("ocupado");
            cerrarFormulario();
        }
    </script>



<button class="btn-ingresar" onclick="location.href='INDEX.html'">VOLVER</button>

</body>
</html>
