<?php
include 'C:/xampp/htdocs/proyecto/mysql/conexion.php';

// Obtener todos los usuarios registrados
try {
    $sql_usuarios = "SELECT id_usuario, nombre, email FROM usuarios";
    $stmt_usuarios = $conexion->prepare($sql_usuarios);
    $stmt_usuarios->execute();
    $usuarios = $stmt_usuarios->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al obtener los usuarios: " . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear_proyecto'])) {
    // Obtener datos del formulario
    $usuarios_seleccionados = $_POST['id_usuario'] ?? []; // Validación adicional
    $nombre_proyecto = trim($_POST['nombre_proyecto']);
    $descripcion = trim($_POST['descripcion']);
    $fecha_entrega = $_POST['fecha_entrega'];

    if (empty($nombre_proyecto) || empty($descripcion) || empty($fecha_entrega) || empty($usuarios_seleccionados)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    $nombre_archivo_destino = null;

    // Subir archivo si existe
    if (isset($_FILES['archivo'])) {
        try {
            $nombre_archivo_destino = subirArchivo(
                $_FILES['archivo'], 
                'C:/xampp/htdocs/proyecto/uploads/', 
                ['pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'], 
                5 * 1024 * 1024 // 5MB máximo
            );
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    try {
        // Iniciar transacción
        $conexion->beginTransaction();

        // Insertar el proyecto y obtener su ID
        $sql_proyecto = "INSERT INTO proyectos (nombre_proyecto, descripcion, fecha_entrega, archivo) 
                         VALUES (:nombre_proyecto, :descripcion, :fecha_entrega, :archivo)";
        $stmt = $conexion->prepare($sql_proyecto);
        $stmt->bindParam(':nombre_proyecto', $nombre_proyecto, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_entrega', $fecha_entrega, PDO::PARAM_STR);
        $stmt->bindParam(':archivo', $nombre_archivo_destino, PDO::PARAM_STR);
        $stmt->execute();

        $id_proyecto = $conexion->lastInsertId(); // Obtener el ID del proyecto recién creado

        // Insertar relaciones en la tabla usuarios_proyectos
        $sql_usuarios_proyectos = "INSERT INTO usuarios_proyectos (id_proyecto, id_usuario) 
                                   VALUES (:id_proyecto, :id_usuario)";
        $stmt_relacion = $conexion->prepare($sql_usuarios_proyectos);

        foreach ($usuarios_seleccionados as $id_usuario) {
            // Enlazar parámetros en cada iteración
            $stmt_relacion->bindValue(':id_proyecto', $id_proyecto, PDO::PARAM_INT);
            $stmt_relacion->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt_relacion->execute();
        }

        // Confirmar transacción
        $conexion->commit();

        // Redirigir o mostrar mensaje de éxito
        header("Location: proyect.php");
        exit;
    } catch (PDOException $e) {
        $conexion->rollBack(); // Revertir cambios en caso de error
        echo "Error al crear el proyecto: " . $e->getMessage();
    }
}

function subirArchivo($archivo, $rutaDestino, $extensionesPermitidas, $tamañoMaximo) {
    if ($archivo['error'] != UPLOAD_ERR_OK) {
        throw new Exception("Error al subir el archivo.");
    }

    $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));

    if (!in_array($extension, $extensionesPermitidas)) {
        throw new Exception("Tipo de archivo no permitido. Extensiones permitidas: " . implode(', ', $extensionesPermitidas));
    }

    if ($archivo['size'] > $tamañoMaximo) {
        throw new Exception("El archivo excede el tamaño máximo permitido.");
    }

    $nombreUnico = uniqid() . "." . $extension;
    $rutaArchivo = $rutaDestino . $nombreUnico;

    if (!move_uploaded_file($archivo['tmp_name'], $rutaArchivo)) {
        throw new Exception("Error al mover el archivo al directorio destino.");
    }

    return $nombreUnico;
}
?>
