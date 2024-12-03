<?php 
include 'controlador1.php';
include 'controlador_home.php';
if (!is_array($proyectos_con_tiempos)) {
    echo 'Error al cargar proyectos';
    exit; 
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        function actualizarHora() {
            const reloj = document.getElementById('reloj');
            const fecha = new Date();
            const horas = fecha.getHours().toString().padStart(2, '0');
            const minutos = fecha.getMinutes().toString().padStart(2, '0');
            const segundos = fecha.getSeconds().toString().padStart(2, '0');
            reloj.textContent = `${horas}:${minutos}:${segundos}`;
        }
        setInterval(actualizarHora, 1000); 
    </script>
</head>
<body>
    <br>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Proyectos Completados</span>
                            <span class="info-box-number"><?= isset($completados) ? $completados : 0 ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-times-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Proyectos Incompletos</span>
                            <span class="info-box-number"><?= isset($incompletos) ? $incompletos : 0 ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Miembros en SENATI</span>
                            <span class="info-box-number"><?= isset($miembros) ? $miembros : 0 ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-clock"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Hora Actual</span>
                            <span class="info-box-number" id="reloj">00:00:00</span>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </section>
    <br>
    <section>
    <div class="container-fluid">
    <div class="row">
        <!-- Pendientes -->
        <div class="col-md-6">
            <div class="card card-primary shadow-none">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight: bold; color: white;">Pendientes</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <?php if (count($proyectos_con_tiempos) > 0): ?>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre del Proyecto</th>
                                    <th>Fecha de entrega</th>
                                    <th>Tiempo restante</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($proyectos_con_tiempos as $proyecto): ?>
                                <tr class="<?php echo $proyecto['color']; ?>">
                                    <td><?php echo htmlspecialchars($proyecto['nombre_proyecto']); ?></td>
                                    <td><?php echo htmlspecialchars($proyecto['fecha_entrega']); ?></td>
                                    <td><?php echo htmlspecialchars($proyecto['tiempo_restante']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p>No tienes proyectos incompletos en este momento.</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <!-- Carrusel de imagen -->
            <div class="row">
                <div class="col-md-12">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class=""></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="3" class="active"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item">
                                <img class="d-block w-100" src="https://www.senati.edu.pe/sites/default/files/home_slides/sin_cta_banner_web_senati-admision2025_1_1.jpg" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="https://www.senati.edu.pe/sites/default/files/home_slides/bannerweb2-carreras4anos_1.jpg" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="https://www.senati.edu.pe/sites/default/files/home_slides/banner_web_senatifest-talara.jpg" alt="Second slide">
                            </div>
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="https://www.senati.edu.pe/sites/default/files/home_slides/bannerweb3-carrerasremotas_1.jpg" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-custom-icon" aria-hidden="true">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-custom-icon" aria-hidden="true">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Alertas de Proyectos -->
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class=""></i>
                                Alertas de Proyectos
                            </h3>
                        </div>
                        <div class="card-body">
                            <?php if (empty($proyectos)): ?>
                                <div class="alert alert-info">
                                    <h5><i class="bi bi-exclamation-triangle"></i> Sin proyectos pendientes</h5>
                                    No tienes proyectos asignados o están todos completados.
                                </div>
                            <?php else: ?>
                                <?php foreach ($proyectos as $proyecto): ?>
                                    <div class="alert 
                                        <?php echo ($proyecto['dias_restantes'] <= 3) ? 'alert-danger' : 'alert-warning'; ?> 
                                        alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h5>
                                            <i class="icon fas 
                                            <?php echo ($proyecto['dias_restantes'] <= 3) ? 'fa-ban' : 'fa-exclamation-triangle'; ?>">
                                            </i> Atención!
                                        </h5>
                                        <?php echo "El proyecto <strong>{$proyecto['nombre_proyecto']}</strong> tiene <strong>{$proyecto['dias_restantes']}</strong> días para que venza."; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section> 
</body>
</html> 
<?php 
// Incluyendo otro controlador
include 'controlador2.php';
?>
<script>
$(function () {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "paging": true,
        "info": true, 
        "searching": false, 
        "ordering": false, 
        "language": {
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ tareas",
            "infoEmpty": "Mostrando 0 a 0 de 0 tareas",
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
<script>
    document.addEventListener("DOMContentLoaded", () => {
    const container = document.getElementById("alert-container");
    let index = 0;
    function cargarAlertas() {
        container.innerHTML = "";
        for (let i = index; i < index + 2 && i < proyectos.length; i++) {
            const proyecto = proyectos[i];
            const alerta = document.createElement("div");
            alerta.className = `alert ${
                proyecto.dias_restantes <= 3 ? "alert-danger" : "alert-warning"
            } alert-dismissible`;
            alerta.innerHTML = `
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5>
                    <i class="icon fas ${
                        proyecto.dias_restantes <= 3 ? "fa-ban" : "fa-exclamation-triangle"
                    }"></i> Atención!
                </h5>
                El proyecto <strong>${proyecto.nombre_proyecto}</strong> tiene <strong>${proyecto.dias_restantes}</strong> días para que venza.
            `;
            alerta.querySelector(".close").addEventListener("click", () => {
                index++; 
                cargarAlertas(); 
            });

            container.appendChild(alerta);
        }
    }
    cargarAlertas();
});

</script>
