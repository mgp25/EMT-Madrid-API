<?php

require __DIR__.'/../vendor/autoload.php';

$debug = true;

$stopId = '680';

$bus = new \EMTMadrid\EMTMadrid($debug);

$query = $bus->getEstimatesIncident($stopId);
$arrive = $query->getArrives()->getArriveEstimationList()->getArrive()[0];

echo 'Parada: '.$arrive->getStopId()."\n";
echo 'Línea: '.$arrive->getLineId()."\n";
echo 'Destino: '.$arrive->getDestination()."\n";
$time = $arrive->getBusTimeLeft();

if ($time == 999999) {
    echo "Tiempo restante a la parada: No disponible.\n\n";
} else {
    $minutes = floor(($time / 60) % 60);
    $seconds = $time % 60;
    echo "Tiempo restante a la parada: $minutes minutos y $seconds segundos\n\n";
}
