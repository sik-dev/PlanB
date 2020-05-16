<?php


$datos = ViajeManager::getAllTestAdmin();

for ($i = 0; $i < count($datos); $i++) {
    $datos[$i]['etiquetas'] = explode('/', $datos[$i]['viaje']->getEtiquetas());
    $datos[$i]['ciudad'] = $datos[$i]['viaje']->getCiudadDestino();
    $datos[$i]['precio'] = $datos[$i]['viaje']->getPrecio();
    $datos[$i]['img'] = $datos[$i]['viaje']->getFoto();
    $datos[$i]['user'] = $datos[$i]['viaje']->getIdUser();
    $datos[$i]['id'] = $datos[$i]['viaje']->getId();
}

/*
echo '<pre>';
print_r($datos);
echo '</pre>';
*/

$obj = json_encode($datos, JSON_UNESCAPED_UNICODE);
echo $obj;
 

?>
