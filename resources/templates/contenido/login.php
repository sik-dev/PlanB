<?php

 $errores = [];
 $info = ['nombre' =>'', 'pass'=>''];
 $redirect = 'inicio.php';

 if( isset($_GET['redirect']) && $_GET['redirect'] != '' ){
   $redirect = $_GET['redirect'];
 }

 if ( count($_POST) > 0) {
   gestionaErrores($_POST, $info, $errores);
   $redirect = $_POST['redirect'];

   if ( $errores == null ) {
     $datos = UsuarioManager::autentificado($info['nombre']);
     $id = $datos['id'];

     if( $datos != null && password_verify($info['pass'], $datos['pass']) ){
       $_SESSION['autentificado'] = true;
       $_SESSION['id'] = $id;

       //RECUERDAME
       if( $_POST['recuerdame'] == true ){
         $token = getToken();                                    //generamos un token y lo convertimos a hash
         //ViajesManager::insertCookieSesion([$token, $id]);       //insertamos el token en la base de datos
        CookieManager::insert($token, $id);
         setcookie('recuerdame', $token, time()+(24*60*60*7));  //se establece la cookie de recuerdame
       }
       header("Location: $redirect");
       die();
     }else{
       $errores['db'] = 'El usuario o la contraseña no estan registrados';
     }
   }
 }

?>
<link rel="stylesheet" href="/css/login.css">
 <div class="login">
   <form class="" action="login.php" method="post">
     <input type="text" name="nombre" value="<?=$info['nombre']?>" placeholder="Introduce tu nombre">
     <?php if( isset($errores['nombre'])) { ?>
       <br><span class='error'><?=$errores['nombre']?></span><br>
     <?php } ?>
     <br>
     <input type="password" name="pass" value="" placeholder="Introduce tu contraseña">
     <?php if( isset($errores['pass'])) { ?>
       <br><span class='error'><?=$errores['pass']?></span><br>
     <?php } ?>
     <br>
     <input type="text" name="redirect" value="<?=$redirect?>" hidden>
     <label for="recuerdame">Recuerdame</label> <input type="checkbox" name="recuerdame" value="true" id="recuerdame">
     <br>
     <a href="password.php" id="olvidadoContraseña">¿Has olvidado tu contraseña?</a>
     <br>
     <input type="submit" name="enviar" value="Enviar">
      <a href="formulario.php?redirect=<?=$redirect?>">Registrate</a>
      <?php if( isset($errores['db'])) { ?>
        <br><br><span class='error'><?=$errores['db']?></span><br>
      <?php } ?>
   </form>
 </div>
