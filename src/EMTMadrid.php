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
     * @param bool  $debug          Show API queries and responses.
     * @param bool  $truncatedDebug Truncate long responses in debug.
     */
    public function __construct(
        $debug = false,
        $truncatedDebug = false)
    {
        $this->http = new \EMTMadrid\HttpInterface();
        $this->http->setDebug($debug);
        $this->http->setTruncatedDebug($truncatedDebug);
    }

    // YYYYMMDD
    public function getCalendar(
        $SelectDateBegin,
        $SelectDateEnd)
    {
      $data = array(
        'SelectDateBegin' => $SelectDateBegin,
        'SelectDateEnd'   => $SelectDateEnd
      );
      $this->http->sendRequest($data, '/bus/GetCalendar.php');
    }

    // ES | EN
    public function getGroups($cultureInfo = 'ES')
    {
      $this->http->sendRequest(array($cultureInfo), '/bus/GetGroups.php');
    }

    // empty lines-> all
    //dd/MM/yyyy,
    public function getListLines(
        $selectDate,
        $lines = null)
    {
      if (is_array($lines))
        $lines = implode('|', $lines);
      $data = array(
        'SelectDate' => $selectDate,
        'Lines'    => $lines
      );

      $this->http->sendRequest($data, '/bus/GetListLines.php');
    }

    public function getNodesLines()
    {
      $this->http->sendRequest(null, '/bus/GetNodesLines.php');
    }

    //dd/MM/yyyy,
    public function getRouteLines(
        $selectDate,
        $lines = null)
    {
      $data = array(
        'SelectDate' => $selectDate,
        'Lines'    => $lines
      );

      $this->http->sendRequest($data, '/bus/GetRouteLines.php');
    }

    //dd/MM/yyyy,
    public function getTimesLines(
        $selectDate,
        $lines)
    {
      if (is_array($lines))
        $lines = implode('|', $lines);
      $data = array(
        'SelectDate' => $selectDate,
        'Lines'    => $lines
      );

      $this->http->sendRequest($data, '/bus/GetTimesLines.php');
    }

    //dd/MM/yyyy,
    public function getTimeTableLines(
        $selectDate,
        $lines)
    {
      if (is_array($lines))
        $lines = implode('|', $lines);
      $data = array(
        'SelectDate' => $selectDate,
        'Lines'    => $lines
      );

      $this->http->sendRequest($data, '/bus/GetTimeTableLines.php');
    }

    public function getArriveStop(
        $idStop,
        $cultureInfo = 'ES')
    {
      $data = array(
        'cultureInfo' => $cultureInfo,
        'idStop'    => $idStop
      );
      $this->http->sendRequest($data, '/geo/GetArriveStop.php');
    }

    public function getGeoGroups($cultureInfo = 'ES')
    {
      $data = array(
        'cultureInfo' => $cultureInfo,
      );
      $this->http->sendRequest($data, '/geo/GetGroups.php');
    }

    public function getInfoLine(
        $fecha,
        $line,
        $cultureInfo = 'ES')
    {
      $data = array(
        'cultureInfo' => $cultureInfo,
        'line'      => $line,
        'fecha'     => $fecha
      );
      $this->http->sendRequest($data, '/geo/GetInfoLine.php');
    }

    public function getInfoLineExtended(
        $fecha,
        $line,
        $cultureInfo = 'ES')
    {
      $data = array(
        'cultureInfo' => $cultureInfo,
        'line'      => $line,
        'fecha'     => $fecha
      );
      $this->http->sendRequest($data, '/geo/GetInfoLineExtend.php');
    }

    // call getPointsOfInterestTypes() to get tipos
    public function getPointsOfInterest(
        $latitude,
        $longitude,
        $radius,
        $tipos,
        $cultureInfo = 'ES')
    {
      $data = array(
        'latitude'    => $latitude,
        'longitude'   => $longitude,
        'Radius'    => $radius,
        'tipos'     => $tipos,
        'cultureInfo' => $cultureInfo
      );
      $this->http->sendRequest($data, '/geo/GetPointsOfInterest.php');
    }

    public function getPointsOfInterestTypes($cultureInfo = 'ES')
    {
      $data = array(
        'cultureInfo' => $cultureInfo
      );
      $this->http->sendRequest($data, '/geo/GetPointsOfInterestTypes.php');
    }

    public function getStopsFromStop(
        $idStop,
        $radius,
        $cultureInfo = 'ES')
    {
      $data = array(
        'idStop'    => $idStop,
        'Radius'    => $radius,
        'cultureInfo' => $cultureInfo
      );
      $this->http->sendRequest($data, '/geo/GetStopsFromStop.php');
    }

    public function getStopsFromXY(
        $latitude,
        $longitude,
        $radius,
        $cultureInfo = 'ES')
    {
      $data = array(
        'latitude'    => $latitude,
        'longitude'   => $longitude,
        'Radius'    => $radius,
        'cultureInfo' => $cultureInfo
      );
      $this->http->sendRequest($data, '/geo/GetStopsFromXY.php');
    }

    /**
     * Obtiene una lista de paradas EMT relacionadas con la línea solicitada
     * (opcionalmente en el sentido de recorrido solicitado).
     *
     * @param string $line          Número de la línea.
     * @param int    $direction     Dirección o sentido de la marcha. 1: Ida. 2: Vuelta.
     * @param string $cultureInfo   'ES' para respuesta en español y 'EN' para respuesta en inglés.
     *
     * @return \EMTMadrid\Response\EstimatesIncidentResponse
     */
    public function getStopsLine(
        $line,
        $direction = 1,
        $cultureInfo = 'ES')
    {
        $data = [
            'line'          => $line,
            'direction'     => $direction,
            'cultureInfo'   => $cultureInfo
        ];
        $this->http->sendRequest($data, '/geo/GetStopsLine.php', new Response\StopsLineResponse());
    }

    /**
     * Obtiene los datos de estimación de llegadas del autobús a una parada determinada y sus incidencias.
     *
     * @param string $stopId        Código de la parada.
     * @param string $line          Número de la línea.
     * @param string $cultureInfo   'ES' para respuesta en español y 'EN' para respuesta en inglés.
     *
     * @return \EMTMadrid\Response\EstimatesIncidentResponse
     */
    public function getEstimatesIncident(
        $stopId,
        $line = null,
        $cultureInfo = 'ES')
    {
        $data = [
            'idLine'                                    => $line,
            'idStop'                                    => $stopId,
            'Text'                                      => null,
            'Text_StopRequired_YN'                      => 'N',
            'Audio_StopRequired_YN'                     => 'N',
            'Text_EstimationsRequired_YN'               => 'Y',
            'Audio_EstimationsRequired_YN'              => 'N',
            'Text_IncidencesRequired_YN'                => 'Y',
            'Audio_IncidencesRequired_YN'               => 'N',
            'DateTime_Referenced_Incidencies_YYYYMMDD'  => date("Ymd"),
            'cultureInfo' => $cultureInfo
        ];
      return $this->http->sendRequest($data, '/media/GetEstimatesIncident.php', new Response\EstimatesIncidentResponse());
    }
}
