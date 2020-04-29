<?php

$errores = [];
$info = [
  'local' => '',
  'alojamiento' => '',
  'manana' => '',
  'tarde' => '',
  'noche' => '',
  'idViaje' => ''
];
$idUser = $_POST['idUser'];
$comprobarEtiquetas = ['alojamiento'];

if (count($_POST) > 0) {

  gestionaErrores($_POST, $info, $errores);
  compruebaIsset($comprobarEtiquetas, $errores);

  /* COMPROBAR ERRORES DE IMAGEN/ES Y DEVOLVER EL NOMBRE/S DE LA IMAGEN/ES*/
  $fotoFullName = gestionaFoto('fotos', $errores);

  if (count($errores) > 0) {
    $obj = json_encode($errores);
    echo $obj;
  }else{
    /* rellenar el array paramItinerario */
    $paramItinerario = [
      $info['local'],
      $info['alojamiento'],
      $info['manana'],
      $info['tarde'],
      $info['noche'],
      $info['idViaje']
    ];

    /* array nombres de las imagenes */
    $fotosNames = explode(';', $fotoFullName);
    array_pop($fotosNames);

    ItinerarioManager::insert($paramItinerario, $fotosNames);
    
    /* MOVER IMAGEN A LA CARPETA DE IMAGENES DEL USUARIO */
    $imgTmpName = $_FILES['fotos']['tmp_name'];
    for ($i = 0; $i < count($imgTmpName); $i++) {
      move_uploaded_file($imgTmpName[$i], "$ROOT/public/imgs/$idUser/$fotosNames[$i]");
    }

    $obj = json_encode($info);
    echo $obj;

    /* $idViaje = $info['idViaje'];
    header("Location: viaje.php?id=$idViaje");
    die(); */
  }
}

?>
