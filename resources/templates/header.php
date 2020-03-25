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
 if ( isset($_GET['id']) ){
   $id = intval($_GET['id']);
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
</script>
<header>
  <a href="inicio.php"><img id='logo' src="logos_proyecto/logo1.png" alt=""></a>
  <div class="">
    <h1>PLAN B</h1>
    <h3>Red social de viajes</h3>
  </div>
  <nav>
  <?php  if( isset($_SESSION['autentificado']) && $_SESSION['autentificado'] == true ){ ?>
      <a href="crearViaje_1.php?id=<?=$_SESSION['id']?>">Subir viaje</a>
      <a href="perfil.php" data-id=<?=$_SESSION['id']?> id="perfil">Perfil</a>
      <a href="listaFavoritos.php?id=<?=$_SESSION['id']?>"><img class="favoritos2"src="/logos_proyecto/star_rellena.png"></a>
      <a href="inicio.php?cerrarSesion=true">Cerrar sesion</a>
   <?php }elseif($uri != '/login.php'){ ?>
    <a href="login.php">Login</a>
   <?php }?>
   </nav>
</header>
