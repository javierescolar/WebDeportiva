
<?php

$xml = new SimpleXMLElement('<clasificacion/>');
foreach ($clasificacion as $equipo => $datos) {
    $juego = $xml->addChild($equipo);
    $juego->addChild('GF', $datos['PJ']);
    $juego->addChild('GF', $datos['GF']);
    $juego->addChild('GC', $datos['GC']);
    $juego->addChild('GA', $datos['GA']);
    $juego->addChild('PTS', $datos['PTS']);
   
}
Header('Content-type: text/xml');
header('Content-Disposition: attachment; filename = clasificacion.XML');
echo $xml->asXML();

