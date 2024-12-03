<?php
include 'C:/xampp/htdocs/proyecto/mysql/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<pre>";
    print_r($_POST);  // Muestra los datos enviados por el formulario
    echo "</pre>";
    // Depuración: Verificar que los datos están siendo recibidos
    var_dump($_POST);
    var_dump($_FILES);
    
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $telefono = $_POST['telf'];  // Recibir el teléfono

    // Asignar el grupo predeterminado
    $grupo = 'SENATI';  // Este es el único grupo, por lo tanto, lo asignamos directamente

    // Depuración: Verificar los valores
    echo "Datos recibidos: ";
    echo "Email: " . $email . "<br>";
    echo "Nombre: " . $nombre . "<br>";
    echo "Teléfono: " . $telefono . "<br>";  // Verificar que el teléfono está recibiéndose
    echo "Grupo: " . $grupo . "<br>";

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $img_name = $_FILES['image']['name'];
        $upload_dir = '/proyecto/uploads/';
        $unique_img_name = md5(uniqid(rand(), true)) . '.' . pathinfo($img_name, PATHINFO_EXTENSION);
        $upload_path = $_SERVER['DOCUMENT_ROOT'] . $upload_dir . $unique_img_name;

        // Verificación: ¿Se está subiendo la imagen?
        if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
            $img_path = $unique_img_name;
            echo "Imagen subida con éxito: " . $img_path . "<br>";
        } else {
            echo "Error al cargar la imagen.<br>";
            exit;
        }
    } else {
        $img_path = 'default.jpg';  // Si no se sube imagen, usar una predeterminada
    }

    try {
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verificar si el email ya está registrado
        $sql_check = "SELECT id_usuario FROM usuarios WHERE email = :email";
        $stmt_check = $conexion->prepare($sql_check);
        $stmt_check->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt_check->execute();

        if ($stmt_check->rowCount() > 0) {
            echo "El correo electrónico ya está registrado.<br>";
        } else {
            // Encriptar la contraseña antes de guardarla
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Depuración: Verificar los datos antes de hacer el insert
            echo "Insertando usuario...<br>";
            echo "Email: $email, Nombre: $nombre, Password: $hashed_password, Imagen: $img_path, Grupo: $grupo, Teléfono: $telefono<br>";

            // Insertar el nuevo usuario, incluyendo el teléfono
            $sql_usuario = "INSERT INTO usuarios (email, nombre, password, img, grupo, telf) 
                            VALUES (:email, :nombre, :password, :img, :grupo, :telf)";
            $stmt_usuario = $conexion->prepare($sql_usuario);
            $stmt_usuario->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt_usuario->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt_usuario->bindParam(':password', $hashed_password, PDO::PARAM_STR);
            $stmt_usuario->bindParam(':img', $img_path, PDO::PARAM_STR);
            $stmt_usuario->bindParam(':grupo', $grupo, PDO::PARAM_STR);
            $stmt_usuario->bindParam(':telf', $telefono, PDO::PARAM_STR);  // Agregar el teléfono
            $stmt_usuario->execute();

            echo "Registro exitoso.<br>";
            header("Location: login.php");
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


