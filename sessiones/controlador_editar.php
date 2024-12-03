<?php
include 'C:/xampp/htdocs/proyecto/mysql/conexion.php';

if (isset($_GET['id_proyecto'])) {
    $id_proyecto = intval($_GET['id_proyecto']);
    $stmt = $conexion->prepare("SELECT * FROM proyectos WHERE id_proyecto = ?");
    $stmt->execute([$id_proyecto]);
    $proyecto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($proyecto) {
        echo json_encode($proyecto);
    } else {
        echo json_encode(['error' => 'Proyecto no encontrado']);
    }
}

if (isset($_POST['crear_proyecto'])) {
    $idProyecto = $_POST['id_proyecto'];
    $nombreProyecto = $_POST['nombre_proyecto'];
    $descripcion = $_POST['descripcion'];
    $fechaEntrega = $_POST['fecha_entrega'];

    // No se está editando el archivo, solo se actualizan los otros campos
    $rutaArchivo = null;

    // Actualizar solo los campos nombre, descripción y fecha de entrega
    $sql = "UPDATE proyectos 
            SET nombre_proyecto = :nombre_proyecto, 
                descripcion = :descripcion, 
                fecha_entrega = :fecha_entrega
            WHERE id_proyecto = :id_proyecto";

    $stmt = $conexion->prepare($sql);
    $params = [
        'nombre_proyecto' => $nombreProyecto,
        'descripcion' => $descripcion,
        'fecha_entrega' => $fechaEntrega,
        'id_proyecto' => $idProyecto
    ];
    $stmt->execute($params);

    // Redirigir después de la actualización
    header("Location: tareas_pendientes.php");
    exit;
}
?>
