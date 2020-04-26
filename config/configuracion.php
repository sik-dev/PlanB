<?php

  $config = [
    'site' => 'Proyecto',
    'title' => 'PLAN B',
    'content' => 'PLAN B',
    'content_text' => 'Información sacada del config',
    'db_engine' => 'mysql',
    'db_file' => 'resources/test.sqlite3',
    'ruta_defecto' => '/inicio.php',
    'user' => 'viajes',
    'pass' => 'viajes',
    'db_name' => 'viajes',
    'img_path' => '/resources/images',
    'img_in_url' => '/images'
  ];

  $datosEmail = [
    'correo' => 'daw.planb@gmail.com',
    'pass' => 'planbViajes',
    'server' => 'smtp.gmail.com'
  ];

  spl_autoload_register(function ($name){
    global $ROOT;
    if (file_exists($class_file = "$ROOT/src/$name.php")) {
      require($class_file);
    }else{
      if (file_exists($class_file = "$ROOT/src/Entidades/$name.php")) {
        require($class_file);
      }else{
        $class_file = "$ROOT/src/Managers/$name.php";
        require($class_file);
      }
    }
  });

  function clear_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function gestionaErrores($post, &$info, &$errores)
  {
    foreach($post as $key=>$value){
        if ( isset($post[$key]) && $value !== '' ){
          $info[$key] = clear_input($value);
        } else{
          $errores[$key] = "ERROR ".strtoupper($key);
        }
    }
  }

  function compruebaIsset($array, &$errores)
  {
    foreach($array as $value){
      if (!isset($_POST[$value])){
        $errores[$value] = "ERROR ".strtoupper($value);
      }
    }
  }

  function gestionaFoto($foto, &$errores)
  {
    $typeExt = ['image/jpg', 'image/jpeg', 'image/png'];
    $file = $_FILES[$foto];
    $fileName = explode('.', strtolower($file['name']));
    $imgName = $fileName[0];
    $imgExt = $fileName[1];
    $imgTmpName = $file['tmp_name'];
    $imgSize = $file['size'];

    if ($file['error'] === 0 && in_array($file['type'], $typeExt) && $file != NULL) {
        return str_replace(" ", "_",  $imgName) ."_". uniqid('', true) .".".$imgExt;
    }else{
        $errores[$foto] = "ERROR ".strtoupper($foto);
    }
  }

  function moverFoto($nombreFoto, $rutaFoto){
    move_uploaded_file($nombreFoto, $rutaFoto);
  }

  function getToken(){

    return rand(10000, 90000);
  }

  function fusionarEtiquetas($array){
    return implode('/', $array);
  }
?>
