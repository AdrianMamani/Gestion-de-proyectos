<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en" style="height: auto;"><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>lorem lorem | Gestor</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.1/css/buttons.bootstrap4.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" style="min-height: 100vh;">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="http://localhost/proyecto/home.php" class="nav-link" style="color: black;">
          Inicio
        </a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 100vh;"> 
    <a class="brand-link" style="text-decoration: none;">
      <span class="brand-text font-weight-bold">&nbsp;&nbsp;File|SESSION</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <?php if (isset($_SESSION['nombre_usuario'])): ?>
            <div class="welcome-box" style="display: flex; align-items: center;">
            <img src="http://localhost/proyecto/uploads/<?php echo !empty($_SESSION['img_usuario']) ? $_SESSION['img_usuario'] : 'default.jpg'; ?>" 
                 alt="Usuario"  
             style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%; margin-right: 10px;" />              
             <a href="#" class="d-block" style="text-decoration: none;">
                <b>BIENVENIDO</b> <br> <?= htmlspecialchars($_SESSION['nombre_usuario']) ?>
            </a>
            </div>
          <?php else: ?>
            <a href="#" class="d-block"><b>BIENVENIDO</b> <br> Usuario Desconocido</a>
          <?php endif; ?>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item d-none d-sm-inline-block">
            <a href="http://localhost/proyecto/home.php" class="nav-link" style="background-color: #f9d301; color: black;">
              <i class="nav-icon fas fa-home"></i>
              <p style="font-weight: bold;">Inicio</p>
            </a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="/proyecto/sessiones/contacto.php" class="nav-link" style="background-color: #f9d301; color: black;">
              <i class="nav-icon bi bi-messenger"></i>
              <p style="font-weight: bold;">Contactos</p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link" style="background-color: #f9d301; color: black;">
              <i class="nav-icon bi bi-pencil-square"></i>
              <p style="font-weight: bold;">Tareas</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/proyecto/sessiones/proyect.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear tarea</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/proyecto/sessiones/tareas_pendientes.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tareas pendientes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/proyecto/sessiones/editar_proyecto.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Editar tarea</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="http://localhost/proyecto/formulario/login.php" class="nav-link" style="background-color: red">
              <i class="nav-icon fas fa-door-open"></i>
              <p style="font-weight: bold; color: white;">
                Cerrar sesión
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
  <div class="content-wrapper">
    