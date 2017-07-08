<?php

namespace EMTMadrid;

class EMTMadrid
{
    /**
     * HTTP interface.
     */
    protected $http;

    /**
     * Constructor.
     *
     * @param bool $debug          Show API queries and responses.
     * @param bool $truncatedDebug Truncate long responses in debug.
     */
    public function __construct(
        $debug = false,
        $truncatedDebug = false)
    {
        $this->http = new \EMTMadrid\HttpInterface();
        $this->http->setDebug($debug);
        $this->http->setTruncatedDebug($truncatedDebug);
    }

    /**
     * Obtiene el calendario EMT de tipos de día aplicables a los horarios de
     * las líneas para un rango solicitado inicio-fin.
     *
     * @param string $selectDate    Fecha del día. Formato dd/mm/yyyy.
     * @param string $SelectDateEnd Fecha del día. Formato dd/mm/yyyy.
     *
     * @throws \EMTMadrid\Exception\EMTMadridException
     *
     * @return \EMTMadrid\Response\GetCalendarResponse
     */
    public function getCalendar(
        $SelectDateBegin,
        $SelectDateEnd)
    {
        $data =
        [
            'SelectDateBegin' => $SelectDateBegin,
            'SelectDateEnd'   => $SelectDateEnd,
        ];

        return $this->http->sendRequest($data, '/bus/GetCalendar.php', new Response\GetCalendarResponse());
    }

    /**
     * Devuelve los datos de los distintos tipos de redes de líneas de EMT
     * (regulares, universitarias, nocturnas, etc), junto con sus distintos desgloses.
     *
     * @param string $cultureInfo 'ES' para respuesta en español y 'EN' para respuesta en inglés.
     *
     * @throws \EMTMadrid\Exception\EMTMadridException
     *
     * @return \EMTMadrid\Response\GetGroupsResponse
     */
    public function getGroups($cultureInfo = 'ES')
    {
        $data =
        [
            'cultureInfo' => $cultureInfo,
        ];

        return $this->http->sendRequest($data, '/bus/GetGroups.php', new Response\GetGroupsResponse());
    }

    /**
     * Recupera la relación general de líneas con su descripción y subgrupo al que pertenencen.
     *
     * @param string          $selectDate Fecha del día. Formato dd/mm/yyyy.
     * @param string|string[] $lines      Una o varias líneas de bus. null para todas las líneas.
     *
     * @throws \EMTMadrid\Exception\EMTMadridException
     *
     * @return \EMTMadrid\Response\GetListLinesResponse
     */
    public function getListLines(
        $selectDate,
        $lines = null)
    {
        if (is_array($lines)) {
            $lines = implode('|', $lines);
        }
        $data =
        [
            'SelectDate' => $selectDate,
            'Lines'      => $lines,
        ];

        return $this->http->sendRequest($data, '/bus/GetListLines.php', new Response\GetListLinesResponse());
    }

    /**
     * Recupera todos los identificadores de parada, junto con su coordenada UTM,
     * nombre y la relación de líneas/sentido que pasan por cada uno de ellos.
     *
     * @param string $nodes Código de la parada. null para todas las paradas.
     *
     * @throws \EMTMadrid\Exception\EMTMadridException
     *
     * @return \EMTMadrid\Response\GetNodesLinesResponse
     */
    public function getNodesLines($nodes = null)
    {
        $data =
        [
            'nodes' => $nodes,
        ];

        return $this->http->sendRequest($data, '/bus/GetNodesLines.php', new Response\GetNodesLinesResponse());
    }

    /**
     * Se obtiene el itinerario de una línea o varías líneas, con los vértices
     *  para construir las rectas del recorrido y las coordenadas UTM de los
     *  ejes viales y los códigos de parada.
     *
     * @param string          $selectDate Fecha del día. Formato dd/mm/yyyy.
     * @param string|string[] $lines      Una o varias líneas de bus.
     *
     * @throws \EMTMadrid\Exception\EMTMadridException
     *
     * @return \EMTMadrid\Response\GetTimesLinesResponse
     */
    public function getRouteLines(
        $selectDate,
        $lines = null)
    {
        if (is_array($lines)) {
            $lines = implode('|', $lines);
        }
        $data =
        [
            'SelectDate' => $selectDate,
            'Lines'      => $lines,
        ];

        return $this->http->sendRequest($data, '/bus/GetRouteLines.php', new Response\GetTimesLinesResponse());
    }

    /**
     * Recupera los horarios vigentes para todos los tipos de día de las líneas solicitadas.
     *
     * @param string          $selectDate Fecha del día. Formato dd/mm/yyyy.
     * @param string|string[] $lines      Una o varias líneas de bus.
     *
     * @throws \EMTMadrid\Exception\EMTMadridException
     *
     * @return \EMTMadrid\Response\GetTimesLinesResponse
     */
    public function getTimesLines(
        $selectDate,
        $lines)
    {
        if (is_array($lines)) {
            $lines = implode('|', $lines);
        }
        $data =
        [
            'SelectDate' => $selectDate,
            'Lines'      => $lines,
        ];

        return $this->http->sendRequest($data, '/bus/GetTimesLines.php', new Response\GetTimesLinesResponse());
    }

    /**
     * Proporciona información de la línea solicitada con un detalle a nivel de viaje.
     *
     * @param string          $selectDate Fecha del día actual. Formato dd/mm/yyyy.
     * @param string|string[] $lines      Una o varias líneas de bus.
     *
     * @throws \EMTMadrid\Exception\EMTMadridException
     *
     * @return \EMTMadrid\Response\GetTimeTableLinesResponse
     */
    public function getTimeTableLines(
        $selectDate,
        $lines)
    {
        if (is_array($lines)) {
            $lines = implode('|', $lines);
        }
        $data =
        [
            'SelectDate' => $selectDate,
            'Lines'      => $lines,
        ];

        return $this->http->sendRequest($data, '/bus/GetTimeTableLines.php', new Response\GetTimeTableLinesResponse());
    }

    /**
     * Obtiene los datos de estimación de llegadas del autobús a una parada determinada.
     *
     * @param string $stopId      Código de la parada.
     * @param string $cultureInfo 'ES' para respuesta en español y 'EN' para respuesta en inglés.
     *
     * @throws \EMTMadrid\Exception\EMTMadridException
     *
     * @return \EMTMadrid\Response\GetArriveStopResponse
     */
    public function getArriveStop(
        $idStop,
        $cultureInfo = 'ES')
    {
        $data =
        [
            'idStop'        => $idStop,
            'cultureInfo'   => $cultureInfo,
        ];

        return $this->http->sendRequest($data, '/geo/GetArriveStop.php', new Response\GetArriveStopResponse());
    }

    /**
     * Devuelve la relación de grupos de explotación.
     *
     * @param string $cultureInfo 'ES' para respuesta en español y 'EN' para respuesta en inglés.
     *
     * @throws \EMTMadrid\Exception\EMTMadridException
     *
     * @return \EMTMadrid\Response\GetGeoGroupsResponse
     */
    public function getGeoGroups($cultureInfo = 'ES')
    {
        $data =
        [
            'cultureInfo' => $cultureInfo,
        ];

        return $this->http->sendRequest($data, '/geo/GetGroups.php', new Response\GetGeoGroupsResponse());
    }

    /**
     * Es el mismo método que GetInfoLine pero proporciona información avanzada
     * acerca de las frecuencias publicadas y otros datos relevantes.
     *
     * @param string $fecha       Fecha de referencia para los datos. Formato dd/mm/yyyy.
     * @param string $line        Número de la línea.
     * @param string $cultureInfo 'ES' para respuesta en español y 'EN' para respuesta en inglés.
     *
     * @throws \EMTMadrid\Exception\EMTMadridException
     *
     * @return \EMTMadrid\Response\GetInfoLineResponse
     */
    public function getInfoLine(
        $fecha,
        $line,
        $cultureInfo = 'ES')
    {
        $data =
        [
            'line'        => $line,
            'fecha'       => $fecha,
            'cultureInfo' => $cultureInfo,
        ];

        return $this->http->sendRequest($data, '/geo/GetInfoLine.php', new Response\GetInfoLineResponse());
    }

    /**
     * Es el mismo método que GetInfoLine() pero proporciona información avanzada
     * acerca de las frecuencias publicadas y otros datos relevantes.
     *
     * @param string $fecha       Fecha de referencia para los datos. Formato dd/mm/yyyy.
     * @param string $line        Número de la línea.
     * @param string $cultureInfo 'ES' para respuesta en español y 'EN' para respuesta en inglés.
     *
     * @throws \EMTMadrid\Exception\EMTMadridException
     *
     * @return \EMTMadrid\Response\GetInfoLineExtendResponse
     */
    public function getInfoLineExtended(
        $fecha,
        $line,
        $cultureInfo = 'ES')
    {
        $data =
        [
            'line'          => $line,
            'fecha'         => $fecha,
            'cultureInfo'   => $cultureInfo,
        ];

        return $this->http->sendRequest($data, '/geo/GetInfoLineExtend.php', new Response\GetInfoLineExtendResponse());
    }

    /**
     * Obtiene la lista de puntos de interés situados a partir de una coordenada
     * y dentro de un radio definido, junto con sus atributos.
     *
     * @param string|float $latitude    Latitud.
     * @param string|float $latitude    Longitud.
     * @param string|int   $radius      Radio de acción en metros.
     * @param string|int   $tipos       @see getPointsOfInterestTypes().
     * @param string       $cultureInfo 'ES' para respuesta en español y 'EN' para respuesta en inglés.
     *
     * @throws \EMTMadrid\Exception\EMTMadridException
     *
     * @return \EMTMadrid\Response\GetPointsOfInterestResponse
     */
    public function getPointsOfInterest(
        $latitude,
        $longitude,
        $radius,
        $tipos,
        $cultureInfo = 'ES')
    {
        $data =
        [
            'latitude'      => $latitude,
            'longitude'     => $longitude,
            'Radius'        => $radius,
            'tipos'         => $tipos,
            'cultureInfo'   => $cultureInfo,
        ];

        return $this->http->sendRequest($data, '/geo/GetPointsOfInterest.php', new Response\GetPointsOfInterestResponse());
    }

    /**
     * Obtiene la relación de los tipos de puntos de interés.
     *
     * @param string $cultureInfo 'ES' para respuesta en español y 'EN' para respuesta en inglés.
     *
     * @throws \EMTMadrid\Exception\EMTMadridException
     *
     * @return \EMTMadrid\Response\GetPointsOfInterestTypesResponse
     */
    public function getPointsOfInterestTypes($cultureInfo = 'ES')
    {
        $data =
        [
            'cultureInfo' => $cultureInfo,
        ];

        return $this->http->sendRequest($data, '/geo/GetPointsOfInterestTypes.php', new Response\GetPointsOfInterestTypesResponse());
    }

    /**
     * Obtiene una lista de paradas EMT situadas desde una coordenada y dentro
     * de un radio predefinido con todos sus atributos, además de las líneas
     * EMT que pasan por cada parada de la lista.
     *
     * @param string     $stopId      Código de la parada.
     * @param string|int $radius      Radio de acción en metros.
     * @param string     $cultureInfo 'ES' para respuesta en español y 'EN' para respuesta en inglés.
     *
     * @throws \EMTMadrid\Exception\EMTMadridException
     *
     * @return \EMTMadrid\Response\GetStopsFromStopResponse
     */
    public function getStopsFromStop(
        $idStop,
        $radius,
        $cultureInfo = 'ES')
    {
        $data =
        [
            'idStop'        => $idStop,
            'Radius'        => $radius,
            'cultureInfo'   => $cultureInfo,
        ];

        return $this->http->sendRequest($data, '/geo/GetStopsFromStop.php', new Response\GetStopsFromStopResponse());
    }

    /**
     * Obtiene una lista de paradas EMT situadas desde una coordenada y dentro
     * de un radio predefinido con todos sus atributos, además de las líneas
     * EMT que pasan por cada parada de la lista.
     *
     * @param string|float $latitude    Latitud.
     * @param string|float $latitude    Longitud.
     * @param string|int   $radius      Radio de acción en metros.
     * @param string       $cultureInfo 'ES' para respuesta en español y 'EN' para respuesta en inglés.
     *
     * @throws \EMTMadrid\Exception\EMTMadridException
     *
     * @return \EMTMadrid\Response\GetStopsFromXYResponse
     */
    public function getStopsFromXY(
        $latitude,
        $longitude,
        $radius,
        $cultureInfo = 'ES')
    {
        $data =
        [
            'latitude'      => $latitude,
            'longitude'     => $longitude,
            'Radius'        => $radius,
            'cultureInfo'   => $cultureInfo,
        ];

        return $this->http->sendRequest($data, '/geo/GetStopsFromXY.php', new Response\GetStopsFromXYResponse());
    }

    /**
     * Obtiene una lista de paradas EMT relacionadas con la línea solicitada
     * (opcionalmente en el sentido de recorrido solicitado).
     *
     * @param string $line        Número de la línea.
     * @param int    $direction   Dirección o sentido de la marcha. 1: Ida. 2: Vuelta.
     * @param string $cultureInfo 'ES' para respuesta en español y 'EN' para respuesta en inglés.
     *
     * @throws \EMTMadrid\Exception\EMTMadridException
     *
     * @return \EMTMadrid\Response\StopsLineResponse
     */
    public function getStopsLine(
        $line,
        $direction = 1,
        $cultureInfo = 'ES')
    {
        $data =
        [
            'line'          => $line,
            'direction'     => $direction,
            'cultureInfo'   => $cultureInfo,
        ];

        return $this->http->sendRequest($data, '/geo/GetStopsLine.php', new Response\StopsLineResponse());
    }

    /**
     * Obtiene los datos de estimación de llegadas del autobús a una parada determinada y sus incidencias.
     *
     * @param string $stopId      Código de la parada.
     * @param string $line        Número de la línea.
     * @param string $cultureInfo 'ES' para respuesta en español y 'EN' para respuesta en inglés.
     *
     * @throws \EMTMadrid\Exception\EMTMadridException
     *
     * @return \EMTMadrid\Response\EstimatesIncidentResponse
     */
    public function getEstimatesIncident(
        $stopId,
        $line = null,
        $cultureInfo = 'ES')
    {
        $data =
        [
            'idLine'                                    => $line,
            'idStop'                                    => $stopId,
            'Text'                                      => null,
            'Text_StopRequired_YN'                      => 'N',
            'Audio_StopRequired_YN'                     => 'N',
            'Text_EstimationsRequired_YN'               => 'Y',
            'Audio_EstimationsRequired_YN'              => 'N',
            'Text_IncidencesRequired_YN'                => 'Y',
            'Audio_IncidencesRequired_YN'               => 'N',
            'DateTime_Referenced_Incidencies_YYYYMMDD'  => date('Ymd'),
            'cultureInfo'                               => $cultureInfo,
        ];

        return $this->http->sendRequest($data, '/media/GetEstimatesIncident.php', new Response\EstimatesIncidentResponse());
    }
}
