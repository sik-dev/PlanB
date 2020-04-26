<?php
//error_reporting(0);

$errores = [];
$info = $_SESSION['viaje'];
/* print_r($_GET); */

/* print_r('<pre>'); */
/* print_r(json_encode($_POST['itinerario'], JSON_UNESCAPED_UNICODE)); */
/* print_r('</pre>'); */
/* $obj = json_encode($nuevoArray, JSON_UNESCAPED_UNICODE); */
$obj = json_encode($_POST['itinerario']);
echo $obj;
if (count($_POST) > 0) {

  /* gestionaErrores($_POST, $info, $errores); */

  /* COMPROBAR ERRORES DE IMAGEN */
/*   $imgFullName = gestionaFoto('img', $errores);
  $imgNuevaRuta = "$ROOT/public/imgs/$id/$fotoItiFullName"; */

  if ($errores == null) {
    /* print_r('<pre>');
    print_r($_POST);
    print_r($_FILES);
    print_r('</pre>'); */
    /* $info['img'] = $fotoItiFullName; */

    /* MOVER IMAGEN A LA CARPETA DE IMAGENES DEL USUARIO */
    //cambiar el mover foto para varias fotos
    /* moverFoto($_FILES['fotoIti']['tmp_name'], $fotoItiNuevaRuta);

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
    die(); */
  }
}

/* if( isset($_GET['id_user']) && !empty($_GET['id_user']) &&
    isset($_GET['id_viaje']) && !empty($_GET['id_viaje']) &&
    isset($_GET['puntuacion']) && !empty($_GET['puntuacion'])
  ) {

  $id_user = intval($_GET['id_user']);
  $id_viaje = intval($_GET['id_viaje']);
  $puntuacion = intval($_GET['puntuacion']);



  //se borra la valoracion de ese Usuario a ese viaje si la hubiera
  ValoracionManager::delete([$id_user, $id_viaje]);

  //se inserta la valoracion
  ValoracionManager::insert($puntuacion, $id_user, $id_viaje);


  $nuevaMedia = ValoracionManager::getMediaViaje($id_viaje)[0]['media'];

  echo $nuevaMedia;
}else{
  echo 'ERROR';
} */

?>
