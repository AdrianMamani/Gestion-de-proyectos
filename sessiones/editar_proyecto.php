<?php 
// Incluye los controladores necesarios
include 'C:/xampp/htdocs/proyecto/controlador1.php';
include 'C:/xampp/htdocs/proyecto/sessiones/controlador_editar.php';

// Conexión a la base de datos
include 'C:/xampp/htdocs/proyecto/mysql/conexion.php';

// Obtener los proyectos desde la base de datos
$stmt = $conexion->prepare("SELECT * FROM proyectos");
$stmt->execute();
$proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proyecto</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <br>
    <form action="controlador_editar.php" method="POST" enctype="multipart/form-data">
        <div class="container-fluid">
            <div class="row">
                <!-- Columna para el formulario -->
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Editar Proyecto</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group col">
                                <label for="id_proyecto">Seleccionar proyecto</label>
                                <select id="id_proyecto" name="id_proyecto" class="form-select">
                                    <option value="">Seleccione un proyecto</option>
                                    <?php foreach ($proyectos as $proyecto): ?>
                                        <option value="<?= $proyecto['id_proyecto'] ?>">
                                            <?= htmlspecialchars($proyecto['nombre_proyecto']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="nombre_proyecto">Nombre del Proyecto</label>
                                <input type="text" id="nombre_proyecto" name="nombre_proyecto" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea id="descripcion" name="descripcion" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="fecha_entrega">Fecha de entrega</label>
                                <input type="date" id="fecha_entrega" name="fecha_entrega" required class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="crear_proyecto" class="btn btn-primary mt-3">Guardar Cambios</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Scripts necesarios -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Autocompletar formulario cuando se seleccione un proyecto
        document.getElementById('id_proyecto').addEventListener('change', function() {
            const idProyecto = this.value;
            if (idProyecto) {
                fetch(`controlador_editar.php?id_proyecto=${idProyecto}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('nombre_proyecto').value = data.nombre_proyecto;
                        document.getElementById('descripcion').value = data.descripcion;
                        document.getElementById('fecha_entrega').value = data.fecha_entrega;
                    })
                    .catch(error => console.error('Error al cargar datos:', error));
            } else {
                // Limpiar el formulario si no hay selección
                document.getElementById('nombre_proyecto').value = '';
                document.getElementById('descripcion').value = '';
                document.getElementById('fecha_entrega').value = '';
            }
        });
    </script>
</body>
</html>
<?php 
// Incluye los controladores necesarios
include 'C:/xampp/htdocs/proyecto/controlador2.php';
?>
