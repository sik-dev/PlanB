<?php

//include("$ROOT/src/DWESBaseDatos.php");

$db = DWESBaseDatos::obtenerInstancia();
$db->inicializa($config['db_name'], $config['user'], $config['pass'], $config['db_engine']);

 ?>
