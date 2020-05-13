<?php

if( !$_SESSION['autentificado'] ){
  header('Location: login.php');
  exit;
}
/* echo "<pre>";
print_r($_FILES);
echo "</pre>"; */

$errores = [];
$paramViaje = [];
$arrayTransporte = ['Coche', 'Avión', 'Autobus', 'Barco', 'Tren'];
$etiquetas = ['Aventuras', 'Cultural', 'Religioso', 'Romántico', 'Con amig@s', 'Gastronómico', 'Relax', 'Fiesta', 'LowCost'];
$comprobarEtiquetas = ['transporte', 'etiquetas'];

$info = ['pais_origen' => '',
         'ciudad_origen' => '',
         'pais_destino' => '',
         'ciudad_destino' => '',
         'foto' => '',
         'precio' => '',
         'transporte' => '',
         'desc' => '',
         'etiquetas' => ''
      ];

if (count($_POST) > 0) {
  gestionaErrores($_POST, $info, $errores);
  compruebaIsset($comprobarEtiquetas, $errores);

  /* COMPROBAR ERRORES DE IMAGEN Y DEVOLVER EL NOMBRE DE LA IMAGEN*/  
  $fotoFullName = gestionaFoto('foto', $errores);

  if ($errores == null) {

    $info['foto'] = $fotoFullName;
    $fotoNuevaRuta = "$ROOT/public/imgs/$id/$fotoFullName";

    /* juntar todas las etiquetas en un string */
    $info['etiquetas'] = fusionarEtiquetas($_POST['etiquetas']);

    /* rellenar el array paramViaje */
    foreach($info as $value){
      array_push($paramViaje, $value);
    }
    array_push($paramViaje, $id);

    $id_viaje = ViajeManager::insert($paramViaje);

    /* MOVER IMAGEN A LA CARPETA DE IMAGENES DEL USUARIO */
    $imgTmpName = $_FILES['foto']['tmp_name'];
    move_uploaded_file($imgTmpName, $fotoNuevaRuta);
    
    header("Location: viaje.php?id=$id_viaje");
    die();
  }
}
?>
<link rel="stylesheet" href="/css/crearViaje_1.css">
<div class="insertViaje">
  <h1>Crear viaje</h1>
  <form action="crearViaje_1.php?id=<?=$id?>" method="post" enctype="multipart/form-data">
    <!-- IMAGEN DEL VIAJE -->
    Foto principal del viaje
    <input type="file" name="foto"><br>
    <?php if( isset($errores['foto'])) { ?>
      <span class='error'><?=$errores['foto']?></span><br>
    <?php } ?>

    <!-- DESCRIPCION DEL VIAJE -->
    <label for="desc">Describe tu viaje: </label>
    <textarea name="desc" id="desc" cols="60" rows="8"><?=$info['desc']?></textarea>
    <?php if( isset($errores['desc'])) { ?>
      <span class='error'><?=$errores['desc']?></span><br>
    <?php } ?>

    <!-- PAIS DE ORIGEN -->
    <label for="pais_origen">País de origen: </label>
    <input type="text" id="pais_origen" name="pais_origen" value="<?=$info['pais_origen']?>">
    <?php if( isset($errores['pais_origen'])) { ?>
      <span class='error'><?=$errores['pais_origen']?></span>
    <?php } ?>

    <!-- CIUDAD DE ORIGEN -->
    <label for="ciudad_origen">Ciudad de origen: </label>
    <input type="text" id="ciudad_origen" name="ciudad_origen" value="<?=$info['ciudad_origen']?>">
    <?php if( isset($errores['ciudad_origen'])) { ?>
      <span class='error'><?=$errores['ciudad_origen']?></span>
    <?php } ?>

    <!-- PAIS DE DESTINO -->
    <label for="pais_destino">País de destino: </label>
    <input type="text" id="pais_destino" name="pais_destino" value="<?=$info['pais_destino']?>">
    <?php if( isset($errores['pais_destino'])) { ?>
      <span class='error'><?=$errores['pais_destino']?></span>
    <?php } ?>

    <!-- CIUDAD DE DESTINO -->
    <label for="ciudad_destino">Ciudad de destino: </label>
    <input type="text" id="ciudad_destino" name="ciudad_destino" value="<?=$info['ciudad_destino']?>">
    <?php if( isset($errores['ciudad_destino'])) { ?>
      <span class='error'><?=$errores['ciudad_destino']?></span>
    <?php } ?>

    <!-- PRECIO DEL VIAJE-->
    <label for="precio">Precio: </label>
    <input type="number" id="precio" name="precio" value="<?=$info['precio']?>" min="1">
    <?php if( isset($errores['precio'])) { ?>
      <span class='error'><?=$errores['precio']?></span>
    <?php } ?>

    <!-- TRANSPORTE USADO PARA VIAJAR -->
    <label for="transporte">Transporte: </label>
    <select id="transporte" name="transporte">
      <option value="" disabled selected>Elige un tipo</option>
        <?php foreach ($arrayTransporte as $valor) { ?>
          <option value="<?=$valor?>" <?=($info['transporte'] == $valor)?'selected':''?>><?=$valor?></option>
        <?php } ?>
    </select>
    <?php if( isset($errores['transporte'])) { ?>
      <span class='error'><?=$errores['transporte']?></span>
    <?php } ?>

    <!-- ETIQUETAS-->
    <label>Etiquetas</label>
    <div class="etiquetas">
      <?php foreach ($etiquetas as $valor) { ?>
        <div class="etiqueta">
          <input type="checkbox" id="<?=$valor?>" name="etiquetas[]" value="<?=$valor?>"
            <?php foreach ($_POST['etiquetas'] as $value) {
              if ($value === $valor) {?>
                <?='checked'?>
            <?php }
            }?>
          >
          <label for='<?=$valor?>'> <?=$valor?></label>
        </div>
      <?php } ?>
      <?php if( isset($errores['etiquetas'])) { ?>
        <span class='error'><?=$errores['etiquetas']?></span>
      <?php } ?>
    </div>

    <button type="submit">Enviar</button>
  </form>
</div>
