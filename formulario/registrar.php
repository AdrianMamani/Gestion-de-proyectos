<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro - SISTEMA DE GESTOR DE MASCOTAS</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body class="hold-transition register-page">
  <div class="register-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="" class="h1"><b>FILE </b>| REGISTRO</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">REGISTRA TU CUENTA</p>
        <form action="controlador_registrar.php" method="post" enctype="multipart/form-data">
          <!-- Campo para el nombre del usuario -->
          <div class="input-group mb-3">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre completo" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <!-- Campo para el correo electrónico -->
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <!-- Campo para el telefono -->
          <div class="input-group mb-3">
            <input type="tel" name="telf" class="form-control" placeholder="Telefono" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone-alt"></span>
              </div>
            </div>
          </div>

          <!-- Campo para la contraseña -->
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <!-- Campo para foto del usuario -->
          <div class="field image">
            <label>Tu Avatar</label>
            <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg,img/" required>
          </div>
          <hr>

          <!-- Botones para enviar el formulario o cancelar -->
          <button type="submit" class="btn btn-primary" style="width: 100%">Registrar</button>
          <br><br>
          <a href="/proyecto/formulario/login.php" class="btn btn-secondary" style="width:100%">Ya tengo cuenta</a>
        </form>
      </div>
    </div>
  </div>

  <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Popper.js (necesario para Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<!-- Bootstrap 4 JS (con Popper.js incluido) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE JS -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>

</body>
</html>


