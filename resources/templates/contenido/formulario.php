<?php

$nombre = "";
$correo = "";
$pais= "";
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
            "Lituania","Luxemburgo","Madagascar","Malasia","Malaui","Maldivas","Malí","Malta",
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
$pass = "";
$passR = "";
$descripcion = '';
$fotoDefault = "profileDefault.png";
$acepta = false;
$errores = [];
$redirect = 'inicio.php';

if( isset($_GET['redirect']) && $_GET['redirect'] != '' ){
  $redirect = $_GET['redirect'];
}

if(count($_POST)>0){
  $redirect = $_POST['redirect'];

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
    //  preg_match('^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$', $_POST['pass']) &&
      $_POST['pass'] == $_POST['passR']
    )
  {
    $pass = clear_input($_POST['pass']);
  }else{
    $errores['pass']= "ERROR PASS";
  }

  if( isset($_POST['pais']) && $_POST['pais'] != ''){
    $pais = clear_input($_POST['pais']);
  }else{
    $errores['pais'] = "ERROR PAIS";
  }
  if( isset($_POST['descripcion']) && $_POST['descripcion'] != ''){
    $descripcion = clear_input($_POST['descripcion']);
  }else{
    $errores['descripcion'] = "ERROR DESCRIPCION";
  }

  if(isset($_POST['terminos']) && $_POST['terminos'] != ""){
    $acepta = true;
  }else{
    $errores['terminos'] = "ERROR TERMINOS";
  }

  if($errores == null){
    $pass = password_hash($pass, PASSWORD_DEFAULT);

    //$info = [$descripcion, $correo, $pass, $nombre, $pais, $fotoDefault];
    //ingresar datos en DB
    $id = UsuarioManager::insert($descripcion, $correo, $pass, $nombre, $pais, $fotoDefault);
    mkdir("$ROOT/public/imgs/$id");

    session_start();
    $_SESSION['autentificado'] = true;

    $_SESSION['id'] = $id;

    header("Location: $redirect");
    die();
  }
}

 ?>
 <link rel="stylesheet" href="/css/formulario.css">
 <div class="formulario">

  <div class="imagen">
    <h1>Todos los destinos al alcance de tu mano</h1>
  </div>

  <h2>Regístrate</h2>

  <form class="animated fadeInLeft" action="formulario.php" method="post" validate=false> 

    <label for='name'>Nombre</label>
    <input type="text" id='name' name="nombre" value="<?=$nombre?>" placeholder="Introduce tu nombre">
    <?php if (isset($errores['nombre'])): ?>
        <label for='nombre' class='error'>Debes introducir un nombre</label>
    <?php endif; ?>

    <label for='correo'>Correo</label>
    <input type="email" id='correo' name="correo" value="<?=$correo?>" placeholder="Introduce un correo valido">
    <?php if (isset($errores['correo'])): ?>
      <label for='correo' class='error'>Debes introducir un correo</label>
    <?php endif; ?>

    <label for='pais'>País</label>
    <select class="" id='pais' name="pais">
      <option disabled selected value="">Elige un país</option>
      <?php foreach ($paises as $valor) {?>
            <option value="<?=$valor?>" <?=($pais == $valor)?'selected':''?>><?=$valor?></option>
      <?php } ?>
    </select>

    <?php if (isset($errores['pais'])): ?>
      <label for='pais' class='error'>Debes introducir un país</label>
    <?php endif; ?>
 
    <label for='descripcion'>Descripción</label>
    <textarea name="descripcion" id='descripcion' placeholder="Cuentano algo sobre ti"  rows="4" cols="20"><?=$descripcion?></textarea>
    <?php if (isset($errores['descripcion'])): ?>
      <label for='descripcion' class='error'>Debes introducir una descripción</label>
    <?php endif; ?>

    <label for='password'>Contraseña</label>
    <input type="password" id='password' name="pass" value="" 
      placeholder="Introduce una contraseña valida"
      pattern="(?=.*\d.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[;$%&#@*\\\+\-?¿!¡])(?!.*\s).{5,10}"
      title="Al menos un dijito, una letra mayúscula, un minuscula y caracter especial"
    >
    <?php if (isset($errores['pass'])): ?>
      <label for='pass' class='error'>Debes introducir una contraseña</label>
    <?php endif; ?>

    <label for='passR'>Repirte la contraseña</label>
    <input type="password" id='passR' name="passR" value="" 
    placeholder="Repite la contraseña"
    pattern="(?=.*\d.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[;$%&#@*\\\+\-?¿!¡])(?!.*\s).{5,10}"
    title="Al menos un dijito, una letra mayúscula, un minuscula y caracter especial"
    >
    <div class='terminos'>
      <label for='terminos'>Acepto los terminos y condiciones</label>
      <input type="checkbox" id='terminos' name="terminos" value="aceptar" <?=($acepta)?'checked':''?>>
    </div>

    <input type="text" name="redirect" value="<?=$redirect?>" hidden>
    <?php if (isset($errores['terminos'])): ?>
      <label for='terminos' class='error'>Debes aceptar los términos</label>
    <?php endif; ?>
    <input id='enviar' type="submit" name="enviar" value="Enviar">

   </form>
 </div>
