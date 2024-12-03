<?php
// Incluye las conexiones y la validación de sesión
include 'C:/xampp/htdocs/proyecto/controlador1.php';
include 'C:/xampp/htdocs/proyecto/mysql/conexion.php';

// Consulta para obtener todos los proyectos con el nombre del usuario
$sql = "SELECT p.id_proyecto, p.nombre_proyecto, p.descripcion, p.fecha_entrega, up.completado, p.archivo, u.nombre AS nombre_usuario, u.id_usuario
        FROM proyectos p
        JOIN usuarios_proyectos up ON p.id_proyecto = up.id_proyecto
        JOIN usuarios u ON up.id_usuario = u.id_usuario";

$stmt = $conexion->prepare($sql);

// Ejecutar la consulta
$stmt->execute();

// Obtener el resultado
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary shadow-none">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight: bold; color: white;">Proyectos del grupo</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Nombre del Proyecto</th>
                                <th>Descripción</th>
                                <th>Fecha de Entrega</th>
                                <th>Nombre del Usuario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($result) > 0) {
                                foreach ($result as $row) {
                                    // Definir el texto y el color del botón
                                    $btn_class = $row['completado'] == 0 ? 'btn-danger' : 'btn-success';
                                    $btn_text = $row['completado'] == 0 ? 'Incompleto' : 'Completado'; // Espacios adicionales en 'Completado'

                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['nombre_proyecto']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['fecha_entrega']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['nombre_usuario']) . "</td>";
                                    echo "<td>";
                                    
                                    // Mostrar el botón de estado de proyecto
                                        echo "<button class='btn " . $btn_class . " btn-toggle' data-id='" . $row['id_proyecto'] . "' data-usuario='" . $row['id_usuario'] . "'>" . $btn_text . "</button>";
                                    // Mostrar el enlace de descarga del archivo
                                    if ($row['archivo']) {
                                        echo " <a href='descargar_archivo.php?archivo=" . urlencode($row['archivo']) . "' class='btn btn-warning'>Ver</a>";
                                    }

                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No hay proyectos registrados.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'C:/xampp/htdocs/proyecto/controlador2.php';
?>
<script>
    document.querySelectorAll('.btn-toggle').forEach(function(button) {
    button.addEventListener('click', function() {
        var id_proyecto = this.getAttribute('data-id');
        var id_usuario = this.getAttribute('data-usuario'); // Obtener el ID del usuario

        // Realizar la actualización con AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'completar_proyecto.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Cambiar el estado del botón después de la actualización
                if (xhr.responseText === 'success') {
                    button.classList.remove('btn-danger');
                    button.classList.add('btn-success');
                    button.textContent = 'Completado   ';  // Asegurarse de que el texto no cambie de tamaño
                } else if (xhr.responseText === 'error') {
                    alert('Hubo un problema al actualizar el proyecto.');
                }
            }
        };
        xhr.send('id_proyecto=' + id_proyecto + '&id_usuario=' + id_usuario);
    });
});
</script>
<script>
$(function () {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "language": {
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ tareas",
            "infoEmpty": "Mostrando 0 a 0 de 0 tareas",
            "infoFiltered": "(Filtrado de _MAX_ total tareas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ tareas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        "buttons": [
            {
                extend: 'copy',
                text: 'Copiar'
            },
            {
                extend: 'csv',
                text: 'CSV'
            },
            {
                extend: 'excel',
                text: 'Excel'
            },
            {
                extend: 'pdf',
                text: 'PDF'
            },
            {
                extend: 'print',
                text: 'Imprimir'
            },
            {
                extend: 'colvis',
                text: 'Visor de columnas'
            }
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "language": {
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ tareas",
            "infoEmpty": "Mostrando 0 a 0 de 0 mascotas",
            "infoFiltered": "(Filtrado de _MAX_ total tareas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ tareas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
});
</script>