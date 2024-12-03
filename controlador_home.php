<?php
include 'C:/xampp/htdocs/proyecto/mysql/conexion.php';

$id_usuario = $_SESSION['id_usuario'] ?? null;

if (!$id_usuario) {
    die("No hay sesión iniciada.");
}

try {
    // Obtener proyectos completados
    $sql_completados = "SELECT COUNT(*) FROM usuarios_proyectos WHERE id_usuario = :id_usuario AND completado = 1";
    $stmt_completados = $conexion->prepare($sql_completados);
    $stmt_completados->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt_completados->execute();
    $completados = $stmt_completados->fetchColumn();

    // Obtener proyectos incompletos
    $sql_incompletos = "SELECT COUNT(*) FROM usuarios_proyectos WHERE id_usuario = :id_usuario AND completado = 0";
    $stmt_incompletos = $conexion->prepare($sql_incompletos);
    $stmt_incompletos->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt_incompletos->execute();
    $incompletos = $stmt_incompletos->fetchColumn();

    // Obtener número de miembros en el grupo "SENATI"
    $sql_miembros = "SELECT COUNT(*) FROM usuarios WHERE grupo = 'SENATI'";
    $stmt_miembros = $conexion->prepare($sql_miembros);
    $stmt_miembros->execute();
    $miembros = $stmt_miembros->fetchColumn();
} catch (PDOException $e) {
    echo "Error al consultar la base de datos: " . $e->getMessage();
}
$query = "
    SELECT p.id_proyecto, p.nombre_proyecto, p.fecha_entrega, up.completado
    FROM proyectos p
    JOIN usuarios_proyectos up ON p.id_proyecto = up.id_proyecto
    WHERE up.id_usuario = :id_usuario
      AND up.completado = 0
    ORDER BY p.fecha_entrega ASC
";
$stmt = $conexion->prepare($query);
$stmt->execute([':id_usuario' => $id_usuario]);
$proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$proyectos_con_tiempos = [];
if (is_array($proyectos) && count($proyectos) > 0) {
    foreach ($proyectos as $proyecto) {
        $fecha_entrega = new DateTime($proyecto['fecha_entrega']);
        $hoy = new DateTime();
        $interval = $hoy->diff($fecha_entrega);
        $color = 'red';

        if ($interval->days > 30) {
            $color = 'green';
        } elseif ($interval->days <= 7) {
            $color = 'yellow'; 
        } elseif ($interval->days <= 3) {
            $color = 'orange'; 
        } elseif ($interval->days <= 1) {
            $color = 'red'; 
        }
        $proyectos_con_tiempos[] = [
            'id_proyecto' => $proyecto['id_proyecto'],
            'nombre_proyecto' => $proyecto['nombre_proyecto'],
            'fecha_entrega' => $fecha_entrega->format('Y-m-d'),
            'tiempo_restante' => $interval->format('%d días, %h horas, %i minutos'),
            'color' => $color
        ];
    }
} else {
    $proyectos_con_tiempos = []; 
}
$sql = "
    SELECT 
        p.id_proyecto,
        p.nombre_proyecto,
        p.fecha_entrega,
        DATEDIFF(p.fecha_entrega, CURDATE()) AS dias_restantes
    FROM proyectos p
    JOIN usuarios_proyectos up ON p.id_proyecto = up.id_proyecto
    WHERE up.id_usuario = :id_usuario AND up.completado = 0
";
$stmt = $conexion->prepare($sql);
$stmt->execute(['id_usuario' => $id_usuario]);
$proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<script>var proyectos = " . json_encode($proyectos) . ";</script>";
?>