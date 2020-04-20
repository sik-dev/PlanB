<?php

if( !$_SESSION['autentificado'] ){
  header('Location: login.php');
  exit;
}

$errores = [];

$info = ['pais_origen' => '',
         'ciudad_origen' => '',
         'pais_destino' => '',
         'ciudad_destino' => '',
         'foto' => '',
         'precio' => '',
         'transporte' => '',
         'desc' => '',
         'local' => '',
         'alojamiento' => '',
         /* 'titulo' => '', */
         'manana' => '',
         'tarde' => '',
         'noche' => '',
         'fotoIti' => ''
      ];

if (isset($_SESSION['viaje'])) {
  $info = $_SESSION['viaje'];
  $info['anterior'] = false;
}

if (count($_POST) > 0) {
  gestionaErrores($_POST, $info, $errores);

  /* COMPROBAR ERRORES DE IMAGEN */
  $fotoFullName = gestionaFoto('foto', $errores);

  if ($errores == null) {
    $info['foto'] = $fotoFullName;
    $fotoNuevaRuta = "$ROOT/public/imgs/$id/$fotoFullName";

    /* MOVER IMAGEN A LA CARPETA DE IMAGENES DEL USUARIO */
    /* moverFoto($_FILES['foto']['tmp_name'], $fotoNuevaRuta); */

    $_SESSION['viaje'] = $info;

    header("Location: crearViaje_2.php?id=$id");
    die();
  }
}
?>
<link rel="stylesheet" href="/css/crearViaje_1.css">
<div class="insertViaje">
  <form action="crearViaje_1.php?id=<?=$id?>" method="post" enctype="multipart/form-data">
    <!-- IMAGEN DEL VIAJE -->
    Foto principal del viaje
    <input type="file" name="foto"><br>
    <?php if( isset($errores['foto'])) { ?>
      <span class='error'><?=$errores['foto']?></span><br>
    <?php } ?>

    <!-- DESCRIPCION DEL VIAJE -->
    <br>
    <textarea name="desc" cols="60" rows="8" placeholder="describe tu viaje"><?=$info['desc']?></textarea><br>
    <?php if( isset($errores['desc'])) { ?>
      <span class='error'><?=$errores['desc']?></span><br>
    <?php } ?>

    <!-- ALOJAMIENTO -->
    <input type="text" name="alojamiento" value="<?=$info['alojamiento']?>" placeholder="alojamiento">
    <?php if( isset($errores['alojamiento'])) { ?>
      <span class='error'><?=$errores['alojamiento']?></span>
    <?php } ?>
    <br>

    <!-- PAIS DE ORIGEN -->
    <input type="text" name="pais_origen" value="<?=$info['pais_origen']?>" placeholder="Pais de origen">
    <?php if( isset($errores['pais_origen'])) { ?>
      <span class='error'><?=$errores['pais_origen']?></span>
    <?php } ?>
    <br>

    <!-- CIUDAD DE ORIGEN -->
    <input type="text" name="ciudad_origen" value="<?=$info['ciudad_origen']?>" placeholder="Ciudad de origen">
    <?php if( isset($errores['ciudad_origen'])) { ?>
      <span class='error'><?=$errores['ciudad_origen']?></span>
    <?php } ?>
    <br>

    <!-- PAIS DE DESTINO -->
    <input type="text" name="pais_destino" value="<?=$info['pais_destino']?>" placeholder="Pais de destino">
    <?php if( isset($errores['pais_destino'])) { ?>
      <span class='error'><?=$errores['pais_destino']?></span>
    <?php } ?>
    <br>

    <!-- CIUDAD DE DESTINO -->
    <input type="text" name="ciudad_destino" value="<?=$info['ciudad_destino']?>" placeholder="Ciudad de destino">
    <?php if( isset($errores['ciudad_destino'])) { ?>
      <span class='error'><?=$errores['ciudad_destino']?></span>
    <?php } ?>
    <br>

    <!-- PRECIO DEL VIAJE-->
    <input type="text" name="precio" value="<?=$info['precio']?>" placeholder="precio">
    <?php if( isset($errores['precio'])) { ?>
      <span class='error'><?=$errores['precio']?></span>
    <?php } ?>
    <br>

    <!-- TRANSPORTE USADO PARA VIAJAR -->
    <input type="text" name="transporte" value="<?=$info['transporte']?>" placeholder="transporte">
    <?php if( isset($errores['transporte'])) { ?>
      <span class='error'><?=$errores['transporte']?></span>
    <?php } ?>
    <br><br>

    <button type="submit">Siguiente</button>
  </form>
</div>
