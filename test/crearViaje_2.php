<?php

/* if (isset($_GET['rellenar']) && !empty($_GET['rellenar'])) {
  echo $obj = json_encode($_POST);
  exit;
} */

if( !$_SESSION['autentificado'] ){
  header('Location: login.php');
  exit;
}

$errores = [];
$info = $_SESSION['viaje'];
/* print_r($_GET);
print_r($_POST); */

if (count($_POST) > 0) {

  /* if (isset($_POST['rellenar']) && !empty($_POST['rellenar'])) {
    $obj = json_encode($_POST);
    echo $obj;
  } */

  gestionaErrores($_POST, $info, $errores);

  if ( isset($_POST['anterior']) && $_POST['anterior'] == true ) {
    $_SESSION['viaje'] = $info;
    header('Location: crearViaje_1.php');
  }

  /* COMPROBAR ERRORES DE IMAGEN */
  $imgFullName = gestionaFoto('img', $errores);
  $imgNuevaRuta = "$ROOT/public/imgs/$id/$fotoItiFullName";

  if ($errores == null) {
    /* print_r('<pre>');
    print_r($_POST);
    print_r($_FILES);
    print_r('</pre>'); */
    $info['img'] = $fotoItiFullName;

    /* MOVER IMAGEN A LA CARPETA DE IMAGENES DEL USUARIO */
    //cambiar el mover foto para varias fotos
    moverFoto($_FILES['fotoIti']['tmp_name'], $fotoItiNuevaRuta);

    $paramViaje = [ $info['pais_origen'],
                    $info['ciudad_origen'],
                    $info['pais_destino'],
                    $info['ciudad_destino'],
                    $info['foto'],
                    $info['precio'],
                    $info['transporte'],
                    $info['desc'],
                    $info['etiquetasFormateadas'],
                    $id
                  ];

    $paramItinerario = [$info['local'],
                        $info['alojamiento'],
                        
                        $info['manana'],
                        $info['tarde'],
                        $info['noche']
                        ];

    $paramFoto = [$info['fotoIti']];

    ViajeManager::insert($paramViaje, $paramItinerario, $paramFoto);

    header("Location: inicio.php");
    $_SESSION['viaje'] = NULL;
    die();
  }
}
?>
<script src="JS/addItinerarios.js"></script>
<link rel="stylesheet" href="/css/crearViaje_2.css">
<div class="insertViaje">
  <form action="crearViaje_2.php?id=<?=$id?>" method="post" enctype="multipart/form-data">
    <div class="itinerario">
      <h1>Dia 1</h1>
      <!-- FOTO DEL ITINERARIO -->
      <input type="file" name="img"><br>
      <?php if( isset($errores['img'])) { ?>
        <br><span class='error'><?=$errores['img']?></span><br>
      <?php } ?>

      <!-- LOCAL -->
      <input type="text" name="local" value="<?=$info['local']?>" placeholder="localizacion">
      <?php if( isset($errores['local'])) { ?>
        <span class='error'><?=$errores['local']?></span>
      <?php } ?>
      <br>

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
    </div>
    <button type="submit" name="anterior" value="true">Anterior</button>
    <button type="submit">Enviar</button>
    <button type="submit" name="addItinerario">Añadir itinerario</button>
  </form>
</div>
