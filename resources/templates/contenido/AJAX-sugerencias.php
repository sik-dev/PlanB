<?php
//error_reporting();
$paises = [
  "Afganistán","Albania","Alemania","Andorra","Angola","Antigua y Barbuda",
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

$ciudades = [
  'Tokio','Nueva York','Los Ángeles','Seúl','Londres','París','Osaka',
  'Shanghái','Chicago','Moscú','Pekín','Colonia','Houston','Washington D. C.',
  'São Paulo','Hong Kong','Dallas','Ciudad de México','Cantón','Tianjin',
  'Singapur','Nagoya','Shenzhen','Boston','Estambul','Filadelfia','Suzhou',
  'San Francisco','Taipei','Yakarta','Ámsterdam','Buenos Aires','Chongqing',
  'Milán','Bangkok','Busan','Atlanta','Delhi','Toronto','Seattle','Miami',
  'Madrid','Bruselas','Chengdu','Wuhan','Frankfurt','Sídney','Múnich','Hangzhou',
  'Wuxi','Minneapolis','Qingdao','Detroit','Phoenix','Nanjing','San Diego',
  'Dalian','Fukuoka','Shenyang','Changsha','Foshan','Viena','Manila','Lingbo',
  'Melbourne','Abu Dhabi','Río de Janeiro','Lima','Baltimore','Kuala Lumpur',
  'Santiago de Chile','Barcelona','Denver','Kuwait','Riad','Roma','Tangshan',
  'Hamburgo','Jeddah','San Jose','Bogotá','Portland','Stuttgart','Berlín',
  'Zhengzhou','Montreal','Riverside','Tel Aviv','Mumbai','Yantai','Estocolmo',
  'Brasilia','Dongguan','Varsovia','San Luis','Pittsburgh','Karlsruhe','Jinan',
  'Perth','Shijiazhuang','Tampa','Atenas','Nantong','Harbin','Sacramento',
  'Copenhague','Charlotte','Changchun',"Xi'an",'Monterrey','Katowice',
  'Birmingham','Hefei','San Petersburgo','Fuzhou','Orlando','Cleveland',
  'Taichung','Kaohsiung','Indianapolis','Xuzhou','Cincinnati','Changzhou',
  'Vancouver','Zúrich','Columbus','Austin','Kansas City','Ankara','San Antonio',
  'El Cairo','Wenzhou','Hartford','Zibo','Aachen','Lille','Daqing','Budapest',
  'Calgary','Lyon','Brisbane','Lisboa','Nanchang','Nashville','Baotou',
  'Las Vegas','Mánchester','Virginia Beach','Eindhoven','Dublín','Praga',
  'Kunming','Taoyuan','Milwaukee','Nápoles','Belo Horizonte','Dongying',
  'Edmonton','Johannesburgo','Dubái','Guadalajara','Sapporo','Bursa','Esmirna',
  'Turín','Providence','Helsinki','Tainan','Xiamen','Sendai','Hiroshima',
  'Leeds','Nürnberg','Oslo','Nueva Orleans','Salt Lake City','Búfalo','Bucarest',
  'Richmond','Ho Chi Minh','Nanning','Hohhot','Oklahoma','Bridgeport','Zhongshan',
  'Rochester','Anshan','Liverpool','Memphis','Raleigh','Jacksonville','Taiyuan',
  'Luxemburgo','Louisville','Porto Alegre','Calcuta','Marseille','Hannover',
  'Urumchi','Campinas','Ciudad del Cabo','Honolulu','Chennai','Shizuoka',
  'Albany','Ottawa','Curitiba','Venecia','Okayama','Glasgow','Basel','East Rand',
  'Daegu','Birmingham','Macau','Baton Rouge','New Haven','Almaty','Valencia',
  'Florencia','Hamamatsu','Caracas','Portsmouth','Grand Rapids','Omaha',
  'Nottingham','Bielefeld','Niigata','Pretoria','Auckland','Durban','Tulsa',
  'Bremen','Bakersfield','Bristol','Adelaide','Toulouse','Oxnard','Nice',
  'Braunschweig','Fresno','Bangalore','Worcester','Newcastle','Linz','Arnhem',
  'Ginebra','Sofia','Medellín','Porto','San Juan','Kumamoto','Madison','Saarbrucken',
  'Zhuhai','Tucson','Greensboro','Little Rock','Syracuse','Recife','Haifa',
  'Bordeaux','Hyderabad','Gotemburgo','Albuquerque','Sheffield','Daejeon',
  'Leipzig','Des Moines','Shantou','Bilbao','Salvador','Hsinchu','Knoxville',
  'Puebla','George Town','Casablanca','Dayton','Allentown','Strasbourg','Columbia',
  'Durham','Gwangju','Bolonia','Cardiff','Sevilla','Vitória','Greenville',
  'Fortaleza','Harrisburg','Kagoshima','Quebec','Cracovia','Akron','Springfield',
  'El Paso','Edimburgo','Winnipeg','Alejandría','Nantes','Álava','Albacete','Alicante',
  'Almería','Asturias','Ávila','Badajoz','Burgos','Cáceres','Cádiz',
  'Cantabria','Castellón','Ciudad Real','Córdoba','La Coruña','Cuenca','Gerona',
  'Guipúzcoa','Huelva','Huesca','Islas Baleares','Jaén','León','Lérida','Lugo',
  'Málaga','Murcia','Navarra','Orense','Palencia','Las Palmas','Pontevedra',
  'La Rioja','Salamanca','Segovia','Soria','Tarragona','Santa Cruz de Tenerife',
  'Teruel','Toledo','Valladolid','Vizcaya','Zamora','Zaragoza'
];

function startsWith ($string, $startString)
{
    $len = strlen($startString);
    return (substr(strtolower($string), 0, $len) === strtolower($startString));
}

function sacarDatos($datos, $sugerencia)
{
  $sugerencias = [];
  foreach($datos as $dato){
    if (startsWith($dato, $sugerencia)) {
      array_push($sugerencias, $dato);
    }
  }

  if (count($sugerencias) > 4) {
    array_splice($sugerencias, 4);
  }
  return $sugerencias;
}

function enviarJSON($sugerencias)
{
  $obj = json_encode($sugerencias);
  echo $obj;
}

if(isset($_GET['suggest']) && !empty($_GET['suggest'])) {  
  $sugerencia = $_GET['suggest'];

  if (!empty($sugerencia)) {
    if(strpos($_GET['opcion'], 'ciudad')){
      enviarJSON(sacarDatos($ciudades, $sugerencia));
    }else if(strpos($_GET['opcion'], 'pais')){
      enviarJSON(sacarDatos($paises, $sugerencia));
    }
  }
}

?>
