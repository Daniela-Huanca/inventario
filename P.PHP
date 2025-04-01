
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de Herramientas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        
        .estado {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
        
        .libre {
            background-color: green;
        }
        
        .ocupado {
            background-color: red;
        }
        
        .entregado {
            background-color: blue;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 5px;
        }
        
        .ver-usuario {
            background-color: orange;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 5px;
        }
        
        #formulario {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px gray;
            border-radius: 5px;
        }
        
        #formulario input,
        #formulario button {
            display: block;
            margin: 10px auto;
        }
    </style>
</head>

<body>

    <h1>Inventario de Herramientas</h1>

    <button id="estadoHerramienta" class="estado libre" onclick="verificarEstado()">Libre</button>
    <button id="botonEntregado" class="entregado" onclick="marcarEntregado()">Entregado</button>
    <button id="verUsuario" class="ver-usuario" onclick="verUsuario()">Ver Quién lo Usa</button>

    <p id="info">Disponible para su uso.</p>

    <!-- Formulario emergente -->
    <div id="formulario">
        <h3>Registro de Herramienta</h3>
        <label>Nombre del Usuario:</label>
        <input type="text" id="nombreUsuario" required>
        <label>Fecha y Hora:</label>
        <input type="datetime-local" id="fechaHora" required>
        <button onclick="guardarRegistro()">Guardar</button>
        <button onclick="cerrarFormulario()">Cancelar</button>
    </div>

    <script>
        function verificarEstado() {
            let estadoBtn = document.getElementById("estadoHerramienta");
            if (estadoBtn.classList.contains("libre")) {
                document.getElementById("formulario").style.display = "block";
            } else {
                alert("La herramienta ya está en uso.");
            }
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

            // Guardar en LocalStorage (puedes reemplazarlo por una base de datos)
            localStorage.setItem("usuario", nombre);
            localStorage.setItem("fecha", fechaHora);

            let estadoBtn = document.getElementById("estadoHerramienta");
            let info = document.getElementById("info");

            info.innerText = `Usado por: ${nombre} - Fecha: ${fechaHora}`;
            estadoBtn.textContent = "En uso";
            estadoBtn.classList.remove("libre");
            estadoBtn.classList.add("ocupado");

            cerrarFormulario();
        }

        function marcarEntregado() {
            let estadoBtn = document.getElementById("estadoHerramienta");
            let info = document.getElementById("info");

            if (estadoBtn.classList.contains("ocupado")) {
                localStorage.removeItem("usuario");
                localStorage.removeItem("fecha");

                estadoBtn.textContent = "Libre";
                estadoBtn.classList.remove("ocupado");
                estadoBtn.classList.add("libre");

                info.innerText = "Disponible para su uso.";
            } else {
                alert("La herramienta ya está libre.");
            }
        }

        function verUsuario() {
            let usuario = localStorage.getItem("usuario");
            let fecha = localStorage.getItem("fecha");

            if (usuario && fecha) {
                alert(`Actualmente en uso por: ${usuario} - Fecha: ${fecha}`);
            } else {
                alert("La herramienta está libre.");
            }
        }
    </script>

</body>

</html>