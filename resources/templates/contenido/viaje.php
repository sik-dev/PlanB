<?php

$comentario = '';
$dibujaEstrella = false;
$etiquetas = [];
$arrayAlojamiento = ['Hotel', 'Apartamento', 'Hostal', 'Vivienda propia', 'Ninguna'];

$imgRandom = mt_rand(2, 18);

if ( isset($_GET['id']) ){
  $id_viaje = $_GET['id'];
  $viajeEnviado = true;
}
/*
if (isset($_POST['comentario']) && $_POST['comentario'] != null) {
  $comentario = $_POST['comentario'];
  $date = new DateTime('now');
  $dateCadena = $date->format('Y-m-d H:i:s');
  ComentarioManager::insert($comentario, $dateCadena, $_SESSION['id'], $id_viaje);
}
*/

$datos = ViajeManager::getById($id_viaje);
if ($datos === null) {
  http_response_code(404);
  header("Location: page404.php");
}
/* print_r(http_response_code()); */
$datosPerfil = UsuarioManager::getBy($datos['viaje']->getIdUser());
$datosItinerario = ItinerarioManager::getBy($id_viaje);
$comentarios = ComentarioManager::getBy($id_viaje);

$viajeFavorito = FavoritosManager::getBy($_SESSION['id']);
//Convertir cadena de etiquetas a un Array
$etiquetas = explode('/', $datos['viaje']->getEtiquetas());

$contador = 1;
/*
foreach ($viajeFavorito as $fila) {
  if ($fila->getIdViaje() == $id_viaje ) $agregaAFavorito = true;
}

*/
/* $idsIguales = ($id === $datos['viaje']->getIdUser());
print_r(!$idsIguales); */
?>
<link rel="stylesheet" href="/css/viaje.css">
<script src="JS/addItinerarios.js"></script>
<div class="contenedor">
  <?php if(count($datos) > 0) {?>
  <div class="datosUsuario">
    <div id="titulo">
      <h1><?=$datos['viaje']->getCiudadDestino()?></h1>
      <div id='avion'>
        <img class="favoritos" src="logos_proyecto/avion_dibujo_vacio.png">
      </div>
      <?php if ($id === $datos['viaje']->getIdUser()) {?>
        <button id="modificar">Modificar Viaje</button>
      <?php }?>
      <div class="puntuacion">
        <div>
          <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
        </div>
        <span id="mediaViaje"><?=$datos['media']?><span>
      </div>
      <div id="usuario">
        <a href="perfilPublico.php?id_user=<?=$datos['viaje']->getIdUser()?>">
          <img class="fotoSmall"src="imgs/<?=$datosPerfil->getId().'/'.$datosPerfil->getFoto()?>" data-idUserViaje="<?=$datos['viaje']->getIdUser()?>">
        </a>
      </div>
    </div>
    <div id="imgViaje">
      <img id='fotoViaje' class="cursor" src="imgs/<?=$datos['viaje']->getIdUser().'/'.$datos['viaje']->getFoto()?>">
    </div>
    <div class="datos">
      <h3><?=$datos['viaje']->getDescripcion()?></h3>
      <p>País: <?=$datos['viaje']->getPaisDestino()?></p>
      <p>Origen: <?=$datos['viaje']->getCiudadOrigen()?></p>
      <p>Precio: <?=$datos['viaje']->getPrecio()?>&euro;</p>
      <p>Nº de Dias: <?=count($datosItinerario)?></p>
      <p>Transporte: <?=$datos['viaje']->getTransporte()?></p>
      <div class="etiquetas">
        <?php foreach ($etiquetas as $valor) {?>
          <span class="<?=($valor =='Con amig@s')?'Amigos':$valor?>" title="<?=$valor?>" alt='<?=$valor?>'></span>
        <?php } ?>
      </div>
      <!-- <br><br> -->
    </div>
  </div>
  <div class="itinerario">
    <h2>Itinerario</h2>
    <ul>
      <?php foreach ($datosItinerario as $fila){ ?>
        <li data-dia='<?=$contador?>'>
          <p>Día <?=$contador++?></p>
        </li>
      <?php } ?>
    </ul>
    <div id="itinerarioDias">
    </div>
    <div class="insertItinerario desaparecer">
      <form action="viaje.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="idUser" value="<?=$datos['viaje']->getIdUser()?>">
        <input type="hidden" name="idViaje" value="<?=$id_viaje?>">
        <input type="file" name="fotos[]" multiple><!-- <br> -->

        <!-- ALOJAMIENTO -->
        <div>
        <label for="alojamiento">Alojamiento: </label>
        <select id="alojamiento" name="alojamiento">
          <option value="" disabled selected>Elige <!-- un tipo de --> alojamiento</option>
            <?php foreach ($arrayAlojamiento as $valor) { ?>
              <option value="<?=$valor?>" <?=($info['alojamiento'] == $valor)?'selected':''?>><?=$valor?></option>
            <?php } ?>
        </select>
        </div>
        <!-- <br> -->

        <!-- LOCAL -->
        <div>
        <label for="local">Ciudad: </label>
        <input id="local" type="text" name="local" value="<?=$info['local']?>">
        </div>
        <!-- <br> -->

        <fieldset>
          <legend>Describe tu dia</legend>
          <!-- MAÑANA -->
          <label for="manana">Mañana: </label><br>
          <textarea id="manana" name="manana" cols="40" rows="2"><?=$info['manana']?></textarea><br>

          <!-- TARDE -->
          <label for="tarde">Tarde: </label><br>
          <textarea id="tarde" name="tarde" cols="40" rows="2"><?=$info['tarde']?></textarea><br>

          <!-- NOCHE -->
          <?php if( isset($errores['noche'])) { ?>
            <br><span class='error'><?=$errores['noche']?></span><br>
          <?php } ?>
          <label for="noche">Noche: </label><br>
          <textarea id="noche" name="noche" cols="40" rows="2"><?=$info['noche']?></textarea><br>
        </fieldset>
        <button type="submit">Añadir</button>
        <button type="submit">Cancelar</button>
      </form>
    </div>
  </div>
  <div class="comentarios">
    <h2>Comentarios</h2>
    <form>
      <textarea name="comentario" rows="8" cols="80" placeholder="Añade un comentario"></textarea>
      <br>
      <input type="text" name="id_viaje" value="<?=$id?>" hidden>
      <button>Enviar</button>
    </form>
  </div>
  <?php }else{ ?>
    <div class="noEncontrado">
      <h1>Viaje no encontrado</h1>
    </div>
  <?php }?>
  <div class="pu">
    <a href="#">
      <img src="imgs/p/publi_<?=$imgRandom?>.jpg" alt="">
    </a>
  </div>
</div>

<script type="text/javascript" src="JS/viaje.js">
  app.iniciar();
</script>
