<?php

/* print_r($_POST); */
$errores = [];
$paramViaje = [];
$arrayTransporte = ['Coche', 'Avión', 'Autobus', 'Barco', 'Tren'];
$etiquetas = ['Aventuras', 'Cultural', 'Religioso', 'Romántico', 'Con amig@s', 'Gastronómico', 'Relax', 'Fiesta', 'LowCost'];
$comprobarEtiquetas = ['transporte', 'etiquetas'];

$info = ['paisDestino' => '',
         'ciudadDestino' => '',
         'foto' => '',
         'precio' => '',
         'transporte' => '',
         'descripcion' => '',
         'etiquetas' => ''
      ];

$respuesta = [
  'errores' => '',
  'imagenBorrado' => '',
  'info' => '',
  'post' => $_POST
];

if (count($_POST) > 0) {
  gestionaErrores($_POST, $info, $errores);
  compruebaIsset($comprobarEtiquetas, $errores);

  /* COMPROBAR ERRORES DE IMAGEN Y DEVOLVER EL NOMBRE DE LA IMAGEN*/  
  $fotoFullName = gestionaFoto('foto', $errores);

  $idUser = $_POST['idUser'];
  $idViaje = $_POST['idViaje'];
  $fotoActual = $_POST['fotoActual'];

  if ($errores == null) {
    $info['foto'] = $fotoFullName;
    $fotoNuevaRuta = "$ROOT/public/imgs/$idUser/$fotoFullName";

    /* juntar todas las etiquetas en un string  */
    $info['etiquetas'] = fusionarEtiquetas($_POST['etiquetas']);

    /*BORRAR LA IMAGEN ACTUAL */
    $respuesta['imagenBorrado'] = unlink("$ROOT/public/imgs/$idUser/$fotoActual");

    /* MOVER IMAGEN NUEVA A LA CARPETA DE IMAGENES DEL USUARIO */
    $imgTmpName = $_FILES['foto']['tmp_name'];
    move_uploaded_file($imgTmpName, $fotoNuevaRuta);

    ViajeManager::update(
      $idViaje,
      $info['foto'],
      $info['paisDestino'],
      $info['ciudadDestino'],
      $info['precio'],
      $info['transporte'],
      $info['descripcion'],
      $info['etiquetas']
    );

    $respuesta['info'] = $info;
  }else{
    $respuesta['errores'] = $errores;
    $respuesta['info'] = $info;
  }

  $obj = json_encode($respuesta);
  echo $obj;
}
