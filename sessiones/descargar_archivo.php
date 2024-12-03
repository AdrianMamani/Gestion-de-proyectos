<?php
if (isset($_GET['archivo'])) {
    $archivo = $_GET['archivo'];

    // Ruta completa del archivo (asegúrate de ajustar la ruta de acuerdo a tu estructura)
    $ruta_archivo = "C:/xampp/htdocs/proyecto/uploads/" . $archivo;

    if (file_exists($ruta_archivo)) {
        // Forzar la descarga
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($ruta_archivo) . '"');
        header('Content-Length: ' . filesize($ruta_archivo));
        readfile($ruta_archivo);
        exit;
    } else {
        echo "El archivo no existe.";
    }
} else {
    echo "No se ha proporcionado un archivo.";
}
?>
