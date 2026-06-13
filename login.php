<?php
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    require_once("libraries/password_compatibility_library.php");
}

require_once("config/db.php");
require_once("classes/Login.php");

$login = new Login();

if ($login->isUserLoggedIn() == true) {
   header("location: stock.php");

} else {
    ?>
	<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Control de Inventario | Login</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous">
  <link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="icon" href="img/logo-icon.png" sizes="32x32" type="image/png">
</head>
<body class="login-page">
  <div class="login-wrapper">
    <div class="login-brand">
      <div class="login-brand-content">
        <img src="img/logo-icon.png" alt="Logo" class="login-logo">
        <h1>Control de Inventario</h1>
        <p>Gestiona tu stock de forma simple, rápida y eficiente.</p>
        <ul class="login-features">
          <li><i class="fa-solid fa-chart-line"></i> Seguimiento en tiempo real</li>
          <li><i class="fa-solid fa-layer-group"></i> Organización por categorías</li>
          <li><i class="fa-solid fa-shield-halved"></i> Acceso seguro por usuario</li>
        </ul>
      </div>
    </div>

    <div class="login-form-panel">
      <div class="login-form-container">
        <div class="login-form-header">
          <h2>Bienvenido</h2>
          <p>Ingresa tus credenciales para continuar</p>
        </div>

        <form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" class="form-signin">
          <?php
            if (isset($login)) {
              if ($login->errors) {
                ?>
                <div class="alert alert-danger alert-dismissible login-alert" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong><i class="fa-solid fa-circle-exclamation"></i> Error</strong>
                  <?php
                  foreach ($login->errors as $error) {
                    echo $error;
                  }
                  ?>
                </div>
                <?php
              }
              if ($login->messages) {
                ?>
                <div class="alert alert-success alert-dismissible login-alert" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong><i class="fa-solid fa-circle-check"></i> Aviso</strong>
                  <?php
                  foreach ($login->messages as $message) {
                    echo $message;
                  }
                  ?>
                </div>
                <?php
              }
            }
          ?>

          <div class="form-group">
            <label for="user_name">Usuario</label>
            <div class="input-icon-group">
              <i class="fa-solid fa-user input-icon"></i>
              <input class="form-control" id="user_name" placeholder="Tu nombre de usuario" name="user_name" type="text" value="" autofocus required>
            </div>
          </div>

          <div class="form-group">
            <label for="user_password">Contraseña</label>
            <div class="input-icon-group">
              <i class="fa-solid fa-lock input-icon"></i>
              <input class="form-control" id="user_password" placeholder="Tu contraseña" name="user_password" type="password" value="" autocomplete="off" required>
            </div>
          </div>

          <button type="submit" class="btn btn-signin" name="login" id="submit">
            <i class="fa-solid fa-arrow-right-to-bracket"></i> Iniciar sesión
          </button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>

	<?php
}
