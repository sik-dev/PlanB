<?php
 session_start();
 global $ROOT;

 //CIERRA SESION
 if( isset($_GET['cerrarSesion']) && $_GET['cerrarSesion'] == true){
   $_SESSION['autentificado'] = false;
   session_destroy();
   setcookie("recuerdame", "", time() - 3600);     //destruir la cookie

   header('Location: inicio.php');
   die();
 }

 $id;
 $uri = $_SERVER['REQUEST_URI'];


//OBTENER ID del USER
 if ( isset($_SESSION['id']) ){
   $id = intval($_SESSION['id']);
   $datosUsuario = UsuarioManager::getBy($id);
 }

 //Si tiene una cookie establecido de RECUERDAME
if(isset($_COOKIE['recuerdame'])){
  $token= $_COOKIE['recuerdame'];

  $id_user = CookieManager::getBy($token)[0]['id_user'];     //comprobamos que el token existe en la base de datos

  //token correcto
  if( $id_user != null){
    setcookie('recuerdame', $_COOKIE['recuerdame'], time()+(24*60*60*7));   //establecemos la cookie otra semana mas

    $_SESSION['autentificado'] = true;      //autentificamos la sesion
    $_SESSION['id'] = $id_user;
  }

}

?>
<link rel="stylesheet" href="/css/header.css">
<header>
  <div id="logo">
    <a href="inicio.php">
      <img src="logos_proyecto/logo1.png" alt="logo Plan B">
    </a>
  </div>
  <div id="nombre">
    <h1>PLAN B</h1>
    <h3>Red social de viajes</h3>
  </div>
  <label for="menu"><img src="logos_proyecto/menu.png" alt="menu"></label>
  <input id="menu" type="checkbox">
  <nav>
    <ul>
      <li><a href="inicio.php">Inicio</a></li>
      <!-- <li><a href="quienesSomos.php">Sobre nosotros</a></li> -->

      <?php if( isset($datosUsuario) && $datosUsuario->getRol() === 'ADMIN') {?>
        <li><a href="admin.php" id="admin">ADMIN</a></li>
      <?php } ?>

      <?php if( isset($_SESSION['autentificado']) && $_SESSION['autentificado'] == true ){ ?>
        <li><a href="crearViaje_1.php?id=<?=$_SESSION['id']?>">Subir viaje</a></li>
        <li><a href="perfil.php" data-id=<?=$_SESSION['id']?> id="perfil">Perfil</a></li>
        <li><a href="listaFavoritos.php?id=<?=$_SESSION['id']?>">Favoritos<img class="favoritos2"src="/logos_proyecto/avion_dibujo_vacio.png"></a></li>
        <li><a href="inicio.php?cerrarSesion=true">Cerrar sesion</a></li>
      <?php }elseif($uri != '/login.php'){ ?>
        <li><a href="login.php">Login</a></li>
      <?php }?>
    </ul>
  </nav>
</header>
