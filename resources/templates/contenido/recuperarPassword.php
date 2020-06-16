<?php
  $errores = [];
  $nuevaPassword;
  

  //print_r($_POST);

  if ( count($_POST) > 0){
    $tokenCorrecto =  true;
    $email = $_POST['email'];

    if (  isset($_POST['password']) &&
          $_POST['password'] != null &&
          isset($_POST['password2']) &&
          $_POST['password'] != null &&
          $_POST['password'] == $_POST['password2']
        ){

      $nuevaPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

      if (count($errores) == 0) {

        UsuarioManager::updatePassword([$nuevaPassword, $email]);

        header("Location: login.php");
        die();
      }

    }else{
      $errores = 'Error en la contraseña, pruebe de nuevo';
    }
  }else if ( count($_GET) > 0){
    if (  isset($_GET['email']) && $_GET['email'] != null &&
          isset($_GET['token']) && $_GET['token'] != null
        ) {

      $email = $_GET['email'];
      $token = $_GET['token'];

      $tokenBD = TokenManager::getBy($email)[0];

    

      if( isset($tokenBD['token']) && $tokenBD['token'] != null && $tokenBD['token'] == $token ){
        $tokenCorrecto =  true;
      }else{
        $tokenCorrecto =  false;
      }
    }else{
      header("Location: login.php");
      die();
    }
  }else{
    header("Location: login.php");
    die();
  }

?>
<link rel="stylesheet" href="/css/recuperarPassword.css">
<div class="recuperarContraseña">
  <?php if ($tokenCorrecto){ ?>
      <h2>Recupera tu contraseña</h2>
      <form action="recuperarPassword.php" method="post">
        <label for='password'>Nueva contraseña</label>
        <input type="password" id='password' name="password" value="" 
          placeholder="Introduce una contraseña valida"
          pattern="(?=.*\d.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[;$%&#@*\\\+\-?¿!¡])(?!.*\s).{5,10}"
          title="Al menos un dijito, una letra mayúscula, un minuscula y caracter especial"
        >
        
        <label for="password2">Repita la contraseña</label>
        <input type="password" id='password2' name="password2" value="" 
          placeholder="Introduce una contraseña valida"
          pattern="(?=.*\d.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[;$%&#@*\\\+\-?¿!¡])(?!.*\s).{5,10}"
          title="Al menos un dijito, una letra mayúscula, un minuscula y caracter especial"
        >

        <input type="text" name="email" value="<?=$email?>" hidden>
        
        <?php if( isset($errores) && $errores != null) { ?>
          <span class="error"><?=$errores?></span>          
        <?php } ?>

        <input id='enviar' type="submit" name="Enviar" value="Enviar">
      </form>
  <?php } ?>
  <?php if (!$tokenCorrecto){ ?>
      <div class='errorContraseña'>
        <p>No se ha podido restablecer la contraseña, pruebe de nuevo.</p>
        <a href="login.php">Login</a>
      </div>
     
  <?php } ?>


</div>
