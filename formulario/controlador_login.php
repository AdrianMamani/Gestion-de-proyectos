<?php
session_start();
include 'C:/xampp/htdocs/proyecto/mysql/conexion.php';

// Verificar si se han enviado los datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Consultar si el email existe en la base de datos
        $sql = "SELECT id_usuario, nombre, password, img FROM usuarios WHERE email = :email";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Obtener los resultados
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $id_usuario = $user['id_usuario'];
            $nombre_usuario = $user['nombre'];  // Obtener el nombre del usuario
            $hashed_password = $user['password'];  // Contraseña encriptada almacenada en la base de datos
            $img_usuario = $user['img'];

            // Verificar si la contraseña es correcta
            if (password_verify($password, $hashed_password)) {
                // Si la contraseña es correcta, iniciar sesión
                $_SESSION['id_usuario'] = $id_usuario;
                $_SESSION['nombre_usuario'] = $nombre_usuario;  // Guardar el nombre del usuario
                $_SESSION['email'] = $email;
                $_SESSION['grupo'] = 'Grupo Único';  // Todos los usuarios están en el mismo grupo
                $_SESSION['img_usuario'] = $img_usuario;

                // Redirigir al inicio o dashboard
                header("Location: ../home.php");
                exit;
            } else {
                // Si la contraseña no es correcta
                echo "Correo o contraseña incorrectos.";
            }
        } else {
            // Si el correo no está registrado
            echo "El correo electrónico no está registrado.";
        }
    } catch (PDOException $e) {
        // Manejo de errores de la base de datos
        echo "Error en la consulta: " . $e->getMessage();
    }
}
?>
