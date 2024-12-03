<?php 
include 'C:/xampp/htdocs/proyecto/controlador1.php';
include 'C:/xampp/htdocs/proyecto/mysql/conexion.php';


if (!isset($_SESSION)) {
    session_start();
}

$id_usuario = $_SESSION['id_usuario'];

$query = "SELECT * FROM usuarios";
$stmt = $conexion->prepare($query);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contactos</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .widget-user {
            border-radius: 10px;
            overflow: hidden;
            background-color: #f8f9fa;
            transition: transform 0.2s ease-in-out;
        }
        .widget-user:hover {
            transform: scale(1.03);
        }
        .widget-user-header {
            text-align: center;
            padding: 20px;
        }
        .widget-user-image img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid white;
        }
        .description-text {
            font-weight: bold;
            color: #6c757d;
        }
        .description-header a {
            color: #05166c;
        }
        .description-header a:hover {
            color: #003399;
        }
    </style>
</head>
<body>
    <br>
    <div class="container-fluid">
        <div class="row g-3"> 
            <?php foreach ($usuarios as $user): ?>
                <div class="col-md-3"> 
                    <div class="card card-widget widget-user shadow"> 
                        <div class="widget-user-header" style="background-color: #05166c; color: white;">
                            <h3 class="widget-user-username"><?php echo htmlspecialchars($user['nombre']); ?></h3>
                            <h7 class="widget-user-desc">"GRUPO SENATI"</h7>
                        </div>
                        <div class="widget-user-image d-flex justify-content-center">
                            <img src="../uploads/<?php echo htmlspecialchars($user['img']); ?>" alt="User Avatar">
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6 text-center">
                                <div class="description-block">
                                    <span class="description-text">Email</span>
                                    <h5 class="description-header">
                                        <a href="mailto:<?php echo htmlspecialchars($user['email']); ?>">
                                            <i class="bi bi-envelope-arrow-up-fill fs-3"></i>
                                        </a>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-6 text-end">
                                <div class="description-block">
                                    <span class="description-text">Telf</span>
                                    <h5 class="description-header">
                                        <a href="https://wa.me/<?php echo htmlspecialchars($user['telf']); ?>" target="_blank"> 
                                            <i class="bi bi-telephone-fill fs-3"></i>
                                        </a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php 
include 'C:/xampp/htdocs/proyecto/controlador2.php';