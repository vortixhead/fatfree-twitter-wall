      <div class="container">
        <div class="row"></div>
      <form class="form-signin" method="POST">
      <img src="ui/images/logo.png" alt="">
        <h2 class="form-signin-heading">Iniciar sesión</h2>
        <label for="username" class="sr-only">Nombre de usuario</label>
        <input name="username" type="text" id="username" class="form-control" placeholder="usuario" required autofocus>
        <label for="password" class="sr-only">Contraseña</label>
        <input name="password" type="password" id="password" class="form-control" placeholder="contraseña" required>
       
        <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
        <p><?php echo $mensaje; ?></p>
      </form>

    </div> <!-- /container -->
          
