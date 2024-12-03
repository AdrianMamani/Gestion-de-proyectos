<?php
$host = 'localhost';
$dbname = 'senati'; 
$username = 'root'; 
$password = ''; 

// Establecer la conexión
try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    echo "Error al conectar: " . $e->getMessage();
}
?>
