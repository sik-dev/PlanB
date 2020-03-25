<?php

if( !$_SESSION['autentificado'] ){
  header('Location: login.php');
  exit;
}

$errores = [];
$info = $_SESSION['viaje'];

if (count($_POST) > 0) {

  gestionaErrores($_POST, $info, $errores);

  if ($_POST['anterior']) {
    $_SESSION['viaje'] = $info;
    header('Location: crearViaje_1.php');
  }

  /* COMPROBAR ERRORES DE IMAGEN */
  $fotoItiFullName = gestionaFoto('fotoIti', $errores);
  $fotoItiNuevaRuta = "$ROOT/public/imgs/$id/$fotoItiFullName";

  if ($errores == null) {
    $info['fotoIti'] = $fotoItiFullName;

    /* MOVER IMAGEN A LA CARPETA DE IMAGENES DEL USUARIO */
    moverFoto($_FILES['fotoIti']['tmp_name'], $fotoItiNuevaRuta);

    $paramViaje = [ $info['pais_origen'],
                    $info['ciudad_origen'],
                    $info['pais_destino'],
                    $info['ciudad_destino'],
                    $info['foto'],
                    $info['precio'],
                    $info['transporte'],
                    $info['desc'],
                    $id
                  ];

    $paramItinerario = [$info['local'],
                        $info['alojamiento'],
                        $info['titulo'],
                        $info['manana'],
                        $info['tarde'],
                        $info['noche'],
                        ];

    $paramFoto = [$info['fotoIti']];

    ViajeManager::insert($paramViaje, $paramItinerario, $paramFoto);

    header("Location: inicio.php");
    $_SESSION['viaje'] = NULL;
    die();
  }
}
?>
<link rel="stylesheet" href="/css/crearViaje_2.css">
<div class="insertViaje">
  <form action="crearViaje_2.php?id=<?=$id?>" method="post" enctype="multipart/form-data">

    <!-- FOTO DEL ITINERARIO -->
    <input type="file" name="fotoIti"><br>
    <?php if( isset($errores['fotoIti'])) { ?>
      <br><span class='error'><?=$errores['fotoIti']?></span><br>
    <?php } ?>

    <!-- LOCAL -->
    <input type="text" name="local" value="<?=$info['local']?>" placeholder="localizacion">
    <?php if( isset($errores['local'])) { ?>
      <span class='error'><?=$errores['local']?></span>
    <?php } ?>
    <br>

    <!-- TITULO DEL ITINERARIO -->
    <input type="text" name="titulo" value="<?=$info['titulo']?>" placeholder="titulo del itinerario">
    <?php if( isset($errores['titulo'])) { ?>
        <br><span class='error'><?=$errores['titulo']?></span><br>
    <?php } ?>

    <!-- MAÑANA -->
    <?php if( isset($errores['manana'])) { ?>
        <br><span class='error'><?=$errores['manana']?></span><br>
    <?php } ?>
    <textarea name="manana" cols="60" rows="3" placeholder="mañana"><?=$info['manana']?></textarea><br>

    <!-- TARDE -->
    <?php if( isset($errores['tarde'])) { ?>
        <br><span class='error'><?=$errores['tarde']?></span><br>
    <?php } ?>
    <textarea name="tarde" cols="60" rows="3" placeholder="tarde"><?=$info['tarde']?></textarea><br>

    <!-- NOCHE -->
    <?php if( isset($errores['noche'])) { ?>
      <br><span class='error'><?=$errores['noche']?></span><br>
    <?php } ?>
    <textarea name="noche" cols="60" rows="3" placeholder="noche"><?=$info['noche']?></textarea><br>

    <button type="submit" name="anterior" value="true">Anterior</button>
    <button type="submit">Enviar</button>
  </form>
</div>
