<?php 
include 'C:/xampp/htdocs/proyecto/controlador1.php';
include 'C:/xampp/htdocs/proyecto/sessiones/controlador_proyect.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Proyecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <br>
    <form action="controlador_proyect.php" method="POST" enctype="multipart/form-data">
        <div class="container-fluid">
            <div class="row">
                <!-- Columna para el formulario -->
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Crear tarea</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nombre_proyecto">Nombre de la tarea</label>
                                <input type="text" id="nombre_proyecto" name="nombre_proyecto" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea id="descripcion" name="descripcion" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="id_usuario">Seleccionar usuarios</label>
                                <div class="dropdown">
                                    <button 
                                        class="btn btn-secondary dropdown-toggle" 
                                        type="button" 
                                        id="dropdownUsuarios" 
                                        data-bs-toggle="dropdown" 
                                        aria-expanded="false">
                                        Seleccionar Usuarios
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownUsuarios">
                                        <?php foreach ($usuarios as $usuario): ?>
                                            <li>
                                                <a 
                                                    class="dropdown-item usuario-item" 
                                                    href="#" 
                                                    data-id="<?= $usuario['id_usuario'] ?>">
                                                    <?= htmlspecialchars($usuario['nombre'] . " (" . $usuario['email'] . ")") ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fecha_entrega">Fecha de entrega</label>
                                <input type="date" id="fecha_entrega" name="fecha_entrega" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="archivo">Subir archivo</label>
                                <input type="file" name="archivo" id="archivo" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" required class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna para los usuarios seleccionados -->
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Usuarios seleccionados</h3>
                        </div>
                        <div class="card-body">
                            <div id="usuariosSeleccionados" class="mt-2">
                                <ul id="listaUsuarios" class="list-group">
                                    <!-- Aquí se mostrarán los usuarios seleccionados -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Campo oculto para enviar los usuarios seleccionados -->
        <div id="usuariosSeleccionadosInputs"></div>

        <div class="container-fluid">
            <button type="submit" name="crear_proyecto" class="btn btn-primary mt-3">Crear Proyecto</button>
        </div>
    </form>

    <!-- Scripts necesarios -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Almacenamiento de los usuarios seleccionados
        let usuariosSeleccionados = [];

        // Función para manejar la selección de usuarios
        document.querySelectorAll('.usuario-item').forEach(item => {
            item.addEventListener('click', function() {
                const usuarioId = this.getAttribute('data-id');
                const nombreUsuario = this.innerText;

                // Si el usuario ya está seleccionado, no lo agregamos nuevamente
                if (!usuariosSeleccionados.includes(usuarioId)) {
                    usuariosSeleccionados.push(usuarioId);
                    // Mostrar el usuario seleccionado en la lista
                    const listaUsuarios = document.getElementById('listaUsuarios');
                    const li = document.createElement('li');
                    li.classList.add('list-group-item');
                    li.textContent = nombreUsuario;
                    // Añadir botón para eliminar el usuario de la lista
                    const btnEliminar = document.createElement('button');
                    btnEliminar.classList.add('btn', 'btn-danger', 'btn-sm', 'float-end');
                    btnEliminar.textContent = 'Eliminar';
                    btnEliminar.onclick = function() {
                        // Eliminar usuario de la lista
                        const index = usuariosSeleccionados.indexOf(usuarioId);
                        if (index !== -1) {
                            usuariosSeleccionados.splice(index, 1);
                        }
                        li.remove();
                        actualizarCampoOculto();
                    };
                    li.appendChild(btnEliminar);
                    listaUsuarios.appendChild(li);
                    // Actualizar el campo oculto con los usuarios seleccionados
                    actualizarCampoOculto();
                }
            });
        });

        // Función para actualizar el valor del campo oculto
        function actualizarCampoOculto() {
            const contenedor = document.getElementById('usuariosSeleccionadosInputs');
            // Limpiar los inputs ocultos existentes
            contenedor.innerHTML = '';

            // Crear un input oculto por cada usuario seleccionado
            usuariosSeleccionados.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'id_usuario[]'; // Usar corchetes para enviar un array
                input.value = id;
                contenedor.appendChild(input);
            });
        }
    </script>
</body>
</html>


<?php 
// Incluye los controladores necesarios
include 'C:/xampp/htdocs/proyecto/controlador2.php';
?>
