<?php

if( !$_SESSION['autentificado'] ){
  header('Location: login.php');
  exit;
}
echo "<pre>";
print_r($_POST);
echo "</pre>";

$errores = [];
$arrayAlojamiento = ['Hotel', 'Apartamento', 'Hostal', 'Vivienda propia', 'Ninguna'];
$arrayTransporte = ['Coche', 'Avión', 'Autobus', 'Barco', 'Tren'];
$etiquetas = ['Aventuras', 'Cultural', 'Religioso', 'Romántico', 'Con amig@s', 'Gastronómico', 'Relax', 'Fiesta', 'Low cost'];

$info = ['pais_origen' => '',
         'ciudad_origen' => '',
         'pais_destino' => '',
         'ciudad_destino' => '',
         'foto' => '',
         'precio' => '',
         'transporte' => '',
         'etiquetas[]' => '',
         'etiquetasFormateadas' => '',
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

    $info['etiquetasFormateadas'] = fusionarEtiquetas($_POST['etiquetas']);

    $_SESSION['viaje'] = $info;

    echo "<pre>";
    print_r($info);
    echo "</pre>";

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
    <label for="desc">Describe tu viaje</label>
    <textarea name="desc" id="desc" cols="60" rows="8"><?=$info['desc']?></textarea><br>
    <?php if( isset($errores['desc'])) { ?>
      <span class='error'><?=$errores['desc']?></span><br>
    <?php } ?>
    <br>

    <!-- ALOJAMIENTO -->
    <label for="alojamiento">Alojamiento</label>
    <select id="alojamiento" name="alojamiento">
      <option value="" disabled selected>Elige un tipo de alojamiento</option>
        <?php foreach ($arrayAlojamiento as $valor) { ?>
          <option value="<?=$valor?>" <?=($info['alojamiento'] == $valor)?'selected':''?>><?=$valor?></option>
        <?php } ?>
    </select>
    <?php if( isset($errores['alojamiento'])) { ?>
      <span class='error'><?=$errores['alojamiento']?></span>
    <?php } ?>
    <br>

    <!-- PAIS DE ORIGEN -->
    <label for="pais_origen">País de origen</label>
    <input type="text" id="pais_origen" name="pais_origen" value="<?=$info['pais_origen']?>">
    <?php if( isset($errores['pais_origen'])) { ?>
      <span class='error'><?=$errores['pais_origen']?></span>
    <?php } ?>
    <br>

    <!-- CIUDAD DE ORIGEN -->
    <label for="ciudad_origen">Ciudad de origen</label>
    <input type="text" id="ciudad_origen" name="ciudad_origen" value="<?=$info['ciudad_origen']?>">
    <?php if( isset($errores['ciudad_origen'])) { ?>
      <span class='error'><?=$errores['ciudad_origen']?></span>
    <?php } ?>
    <br>

    <!-- PAIS DE DESTINO -->
    <label for="pais_destino">País de destino</label>
    <input type="text" id="pais_destino" name="pais_destino" value="<?=$info['pais_destino']?>">
    <?php if( isset($errores['pais_destino'])) { ?>
      <span class='error'><?=$errores['pais_destino']?></span>
    <?php } ?>
    <br>

    <!-- CIUDAD DE DESTINO -->
    <label for="ciudad_destino">Ciudad de destino</label>
    <input type="text" id="ciudad_destino" name="ciudad_destino" value="<?=$info['ciudad_destino']?>">
    <?php if( isset($errores['ciudad_destino'])) { ?>
      <span class='error'><?=$errores['ciudad_destino']?></span>
    <?php } ?>
    <br>

    <!-- PRECIO DEL VIAJE-->
    <label for="precio">Precio</label>
    <input type="number" id="precio" name="precio" value="<?=$info['precio']?>" min="1">
    <?php if( isset($errores['precio'])) { ?>
      <span class='error'><?=$errores['precio']?></span>
    <?php } ?>
    <br>

    <!-- TRANSPORTE USADO PARA VIAJAR -->
    <label for="transporte">Transporte</label>
    <select id="transporte" name="transporte">
      <option value="" disabled selected>Elige un tipo de transporte</option>
        <?php foreach ($arrayTransporte as $valor) { ?>
          <option value="<?=$valor?>" <?=($info['transporte'] == $valor)?'selected':''?>><?=$valor?></option>
        <?php } ?>
    </select>
    <?php if( isset($errores['transporte'])) { ?>
      <span class='error'><?=$errores['transporte']?></span>
    <?php } ?>
    <br>
    <br>
    <!-- ETIQUETAS-->
    <label>Etiquetas</label>
    <br>

    <div class="etiquetas">
      <?php foreach ($etiquetas as $valor) { ?>
        <div class="etiqueta">
          <input type="checkbox" id="<?=$valor?>" name="etiquetas[]" value="<?=$valor?>">
          <label for='<?=$valor?>'> <?=$valor?></label>
        </div>
      <?php } ?>
      <?php if( isset($errores['etiquetas[]'])) { ?>
        <span class='error'><?=$errores['etiquetas[]']?></span>
      <?php } ?>
    </div>

    <br>

    <button type="submit">Siguiente</button>
  </form>
</div>
