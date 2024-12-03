<?php
include 'C:/xampp/htdocs/proyecto/mysql/conexion.php';

// Verificar si se ha recibido el ID del proyecto y el ID del usuario
if (isset($_POST['id_proyecto']) && isset($_POST['id_usuario'])) {
    $id_proyecto = $_POST['id_proyecto'];
    $id_usuario = $_POST['id_usuario'];

    // Obtener el estado actual del proyecto para el usuario específico
    $sql = "SELECT completado FROM usuarios_proyectos WHERE id_proyecto = :id_proyecto AND id_usuario = :id_usuario";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id_proyecto', $id_proyecto, PDO::PARAM_INT);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();
    $proyecto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($proyecto) {
        // Cambiar el estado a 1 si es incompleto (0) o a 0 si es completo (1)
        $nuevo_estado = $proyecto['completado'] == 0 ? 1 : 0;

        // Actualizar el estado del proyecto para este usuario
        $sql = "UPDATE usuarios_proyectos SET completado = :completado WHERE id_proyecto = :id_proyecto AND id_usuario = :id_usuario";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':completado', $nuevo_estado, PDO::PARAM_INT);
        $stmt->bindParam(':id_proyecto', $id_proyecto, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            echo 'success'; // Indicar éxito
        } else {
            echo 'error'; // Indicar error
        }
    } else {
        echo 'error'; // Si no se encuentra el proyecto para este usuario
    }
} else {
    echo 'error'; 
}
?>
