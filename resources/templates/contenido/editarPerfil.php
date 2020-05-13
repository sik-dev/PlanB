<?php

  //si no esta autentificado le mando al login
  if( $_SESSION['autentificado'] != true ) {
    header('Location: login.php');
    exit;
  }

  $user = UsuarioManager::getBy($id);

  /* $nombre;
  $correo;
  $pais;
  $descripcion;
  $pass;
  $passR; */
  /* $fotoDefault; */

  $nombre = $user->getNombre();
  $correo = $user->getEmail();
  $pais = $user->getPass();
  $descripcion = $user->getDescripcion();
  $pass = $user->getPass();
  $passR = $user->getPass();
  $foto = $user->getFoto();

  /* print_r($id); */
  /* print_r($_SESSION['id']); */

  /* if (isset($_GET['id']) && $_GET['id'] != null){

  } */


  $paises = ["Afganistán","Albania","Alemania","Andorra","Angola","Antigua y Barbuda",
              "Arabia Saudita","Argelia","Argentina","Armenia","Australia","Austria",
              "Azerbaiyán","Bahamas","Bangladés","Barbados","Baréin","Bélgica","Belice",
              "Benín","Bielorrusia","Birmania","Bolivia","Bosnia y Herzegovina","Botsuana",
              "Brasil","Brunéi","Bulgaria","Burkina Faso","Burundi","Bután","Cabo Verde",
              "Camboya","Camerún","Canadá","Catar","Chad","Chile","China","Chipre",
              "Ciudad del Vaticano","Colombia","Comoras","Corea del Norte","Corea del Sur",
              "Costa de Marfil","Costa Rica","Croacia","Cuba","Dinamarca","Dominica",
              "Ecuador","Egipto","El Salvador","Emiratos Árabes Unidos","Eritrea",
              "Eslovaquia","Eslovenia","España","Estados Unidos","Estonia","Etiopía",
              "Filipinas","Finlandia","Fiyi","Francia","Gabón","Gambia","Georgia","Ghana",
              "Granada","Grecia","Guatemala","Guyana","Guinea","Guinea ecuatorial",
              "Guinea-Bisáu","Haití","Honduras","Hungría","India","Indonesia","Irak","Irán",
              "Irlanda","Islandia","Islas Marshall","Islas Salomón","Israel","Italia",
              "Jamaica","Japón","Jordania","Kazajistán","Kenia","Kirguistán","Kiribati",
              "Kuwait","Laos","Lesoto","Letonia","Líbano","Liberia","Libia","Liechtenstein",
              "Lituania","Luxemburgo","Madagascar","Maindex.htmllasia","Malaui","Maldivas","Malí","Malta",
              "Marruecos","Mauricio","Mauritania","México","Micronesia","Moldavia","Mónaco",
              "Mongolia","Montenegro","Mozambique","Namibia","Nauru","Nepal","Nicaragua",
              "Níger","Nigeria","Noruega","Nueva Zelanda","Omán","Países Bajos","Pakistán",
              "Palaos","Panamá","Papúa Nueva Guinea","Paraguay","Perú","Polonia","Portugal",
              "Reino Unido","República Centroafricana","República Checa","República de Macedonia",
              "República del Congo","República Democrática del Congo","República Dominicana",
              "República Sudafricana","Ruanda","Rumanía","Rusia","Samoa","San Cristóbal y Nieves",
              "San Marino","San Vicente y las Granadinas","Santa Lucía","Santo Tomé y Príncipe",
              "Senegal","Serbia","Seychelles","Sierra Leona","Singapur","Siria","Somalia",
              "Sri Lanka","Suazilandia","Sudán","Sudán del Sur","Suecia","Suiza","Surinam",
              "Tailandia","Tanzania","Tayikistán","Timor Oriental","Togo","Tonga","Trinidad y Tobago",
              "Túnez","Turkmenistán","Turquía","Tuvalu","Ucrania","Uganda","Uruguay","Uzbekistán",
              "Vanuatu","Venezuela","Vietnam","Yemen","Yibuti","Zambia","Zimbabue"
           ];

  $errores = [];

  if(count($_POST)>0){

    if (isset($_POST['cambiarFoto']) && $_POST['cambiarFoto']) {
      $fotoFullName = gestionaFoto('foto', $errores);
      if (!isset($errores['foto'])) {
        $fotoNuevaRuta = "$ROOT/public/imgs/$id/$fotoFullName";
        //$info = [$fotoFullName, $id];
        unlink("$ROOT/public/imgs/$id/$foto");

        UsuarioManager::update($fotoFullName, $id);
        moverFoto($_FILES['foto']['tmp_name'], $fotoNuevaRuta);
        header("Location: perfil.php");
      }
    }

    if(isset($_POST['nombre']) && $_POST['nombre'] != ""){
      $nombre = clear_input($_POST['nombre']);
    }else{
      $errores['nombre'] = "ERROR NOMBRE";
    }

    if( isset($_POST['correo']) && filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)){
      $correo = clear_input($_POST['correo']);
    }else{
      $errores['correo'] = "ERROR CORREO";
    }

    if(isset($_POST['pass']) &&
        $_POST['pass'] != "" &&
      //  preg_match('^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$', $_POST['pass']) == 1 &&
        $_POST['pass'] == $_POST['passR']
      )
    {
      $pass = clear_input($_POST['pass']);
    }else{
      $errores['pass']= "ERROR PASS";
    }

    if( isset($_POST['descripcion']) && $_POST['descripcion'] != ''){
      $descripcion = clear_input($_POST['descripcion']);
    }else{
      $errores['descripcion'] = "ERROR DESCRIPCION";
    }

    if( isset($_POST['pais']) && $_POST['pais'] != ''){
      $pais = clear_input($_POST['pais']);
    }else{
      $errores['pais'] = "ERROR PAIS";
    }

    if($errores == null){
      $pass = password_hash($pass, PASSWORD_DEFAULT);

      //$info = [$descripcion, $correo, $pass, $nombre, $pais, $_SESSION['id']];
      /* $id = $_SESSION['id']; */
      //ingresar datos en DB
      UsuarioManager::update($descripcion, $correo, $pass, $nombre, $pais, $_SESSION['id']);

      /* $_SESSION['id'] = $id; */

      header("Location: perfil.php");
      die();
    }

  }
?>
<link rel="stylesheet" href="/css/editarPerfil.css">
<div class="editarPerfil">
  <h1>Edita tu perfil</h1>
  <form action="editarPerfil.php?id=<?=$id?>" method="post" enctype="multipart/form-data">
    <!-- CAMBIAR FOTO DE PERFIL -->
    <fieldset>
      <legend>Cambiar foto de perfil</legend>

      <input type="file" name="foto">
      <?php if( isset($errores['foto'])) { ?>
        <span class='error'><?=$errores['foto']?></span><br>
      <?php } ?>
      <button type="submit" name="cambiarFoto" value="true"> Cambiar foto</button>
    </fieldset>
    
    <fieldset>
      <legend>Cambiar información de perfil</legend>

      <label for="name">Introduce tu nombre: </label>
      <input id="name" type="text" name="nombre" value="<?=$nombre?>"><br>
      <?php if (isset($errores['nombre'])): ?>
          <span class='error'><?=$errores['nombre']?></span><br>
      <?php endif; ?>

      <label for="correo">Introduce tu nuevo correo: </label>
      <input id="correo" type="email" name="correo" value="<?=$correo?>"><br>
      <?php if (isset($errores['correo'])): ?>
          <span class='error'><?=$errores['correo']?></span><br>
      <?php endif; ?>

      <label for="pais">País: </label>
      <select id="pais" name="pais">
        <option disabled selected value="">Elige un país</option>
        <?php foreach ($paises as $valor) {?>
              <option value="<?=$valor?>" <?=($pais == $valor)?'selected':''?>><?=$valor?></option>
        <?php } ?>
      </select>
      <?php if (isset($errores['pais'])): ?>
          <br><span class='error'><?=$errores['pais']?></span>
      <?php endif; ?>
      <br>

      <label for="pass">Introduce una nueva contraseña: </label>
      <input id="pass" type="password" name="pass" value="<?php //$pass?>"><br>
      <?php if (isset($errores['pass'])): ?>
          <span class='error'><?=$errores['pass']?></span><br>
      <?php endif; ?>

      <label for="passR">Repite la nueva contraseña: </label>
      <input id="passR" type="password" name="passR" value="<?php //$pass?>"><br>

      <label for="desc">Cuentanos algo sobre ti: </label>
      <textarea id="desc" name="descripcion" rows="8" cols="80"><?=$descripcion?></textarea>
      <?php if (isset($errores['descripcion'])): ?>
          <br><span class='error'><?=$errores['descripcion']?></span>
      <?php endif; ?>
      
      <button type="submit">Enviar</button><br>
    </fieldset>
  </form>
</div>
