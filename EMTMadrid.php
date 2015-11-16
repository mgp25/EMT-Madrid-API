<?php

class EMTMadrid
{
  const IDCLIENT  = 'EMT.SERVICIOS.IPHONE.2.0';
  const PASSKEY   = 'DC352ADB-F31D-41E5-9B95-CCE11B7921F4';
  const URL       = 'https://openbus.emtmadrid.es:9443/emt-proxy-server/last';

  protected $idClient;
  protected $passKey;
  protected $debug;

  public function EMTMadrid($idClient = self::IDCLIENT, $passKey = self::PASSKEY)
  {
    $this->idClient = $idClient;
    $this->passKey  = $passKey;
  }

  // YYYYMMDD
  public function getCalendar($SelectDateBegin, $SelectDateEnd)
  {
    $data = array(
      'SelectDateBegin' => $SelectDateBegin,
      'SelectDateEnd'   => $SelectDateEnd
    );
    $this->sendRequest($data, '/bus/GetCalendar.php');
  }

  // ES | EN
  public function getGroups($cultureInfo = 'ES')
  {
    $this->sendRequest(array($cultureInfo), '/bus/GetGroups.php');
  }

  // empty lines-> all
  //dd/MM/yyyy,
  public function getListLines($selectDate, $lines = null)
  {
    if (is_array($lines))
      $lines = implode('|', $lines);
    $data = array(
      'SelectDate' => $selectDate,
      'Lines'      => $lines
    );

    $this->sendRequest($data, '/bus/GetListLines.php');
  }

  public function getNodesLines()
  {
    $this->sendRequest(null, '/bus/GetNodesLines.php');
  }

  //dd/MM/yyyy,
  public function getRouteLines($selectDate, $lines = null)
  {
    $data = array(
      'SelectDate' => $selectDate,
      'Lines'      => $lines
    );

    $this->sendRequest($data, '/bus/GetRouteLines.php');
  }

  //dd/MM/yyyy,
  public function getTimesLines($selectDate, $lines)
  {
    if (is_array($lines))
      $lines = implode('|', $lines);
    $data = array(
      'SelectDate' => $selectDate,
      'Lines'      => $lines
    );

    $this->sendRequest($data, '/bus/GetTimesLines.php');
  }

  //dd/MM/yyyy,
  public function getTimeTableLines($selectDate, $lines)
  {
    if (is_array($lines))
      $lines = implode('|', $lines);
    $data = array(
      'SelectDate' => $selectDate,
      'Lines'      => $lines
    );

    $this->sendRequest($data, '/bus/GetTimeTableLines.php');
  }

  public function getArriveStop($idStop, $cultureInfo = 'ES')
  {
    $data = array(
      'cultureInfo' => $cultureInfo,
      'idStop'      => $idStop
    );
    $this->sendRequest($data, '/geo/GetArriveStop.php');
  }

  public function getGeoGroups($cultureInfo = 'ES')
  {
    $data = array(
      'cultureInfo' => $cultureInfo,
    );
    $this->sendRequest($data, '/geo/GetGroups.php');
  }

  public function getInfoLine($fecha, $line, $cultureInfo = 'ES')
  {
    $data = array(
      'cultureInfo' => $cultureInfo,
      'line'        => $line,
      'fecha'       => $fecha
    );
    $this->sendRequest($data, '/geo/GetInfoLine.php');
  }

  public function getInfoLineExtended($fecha, $line, $cultureInfo = 'ES')
  {
    $data = array(
      'cultureInfo' => $cultureInfo,
      'line'        => $line,
      'fecha'       => $fecha
    );
    $this->sendRequest($data, '/geo/GetInfoLineExtend.php');
  }

  // call getPointsOfInterestTypes() to get tipos
  public function getPointsOfInterest($latitude, $longitude, $radius, $tipos, $cultureInfo = 'ES')
  {
    $data = array(
      'latitude'    => $latitude,
      'longitude'   => $longitude,
      'Radius'      => $radius,
      'tipos'       => $tipos,
      'cultureInfo' => $cultureInfo
    );
    $this->sendRequest($data, '/geo/GetPointsOfInterest.php');
  }

  public function getPointsOfInterestTypes($cultureInfo = 'ES')
  {
    $data = array(
      'cultureInfo' => $cultureInfo
    );
    $this->sendRequest($data, '/geo/GetPointsOfInterestTypes.php');
  }

  public function getStopsFromStop($idStop, $radius, $cultureInfo = 'ES')
  {
    $data = array(
      'idStop'      => $idStop,
      'Radius'      => $radius,
      'cultureInfo' => $cultureInfo
    );
    $this->sendRequest($data, '/geo/GetStopsFromStop.php');
  }

  public function getStopsFromXY($latitude, $longitude, $radius, $cultureInfo = 'ES')
  {
    $data = array(
      'latitude'    => $latitude,
      'longitude'   => $longitude,
      'Radius'      => $radius,
      'cultureInfo' => $cultureInfo
    );
    $this->sendRequest($data, '/geo/GetStopsFromXY.php');
  }

  public function getStopsLine($line, $cultureInfo = 'ES')
  {
    $data = array(
      'line'        => $line,
      'cultureInfo' => $cultureInfo
    );
    $this->sendRequest($data, '/geo/GetStopsLine.php');
  }

  public function getEstimatesIncident($stopId, $line = null, $cultureInfo = 'ES')
  {
    $data = array(
      'idLine'        => $line,
      'idStop' => $stopId,
      'Text' => null,
      'Text_StopRequired_YN' => 'N',
      'Audio_StopRequired_YN' => 'N',
      'Text_EstimationsRequired_YN' => 'Y',
      'Audio_EstimationsRequired_YN' => 'N',
      'Text_IncidencesRequired_YN' => 'Y',
      'Audio_IncidencesRequired_YN' => 'N',
      'DateTime_Referenced_Incidencies_YYYYMMDD' => date("Ymd"),
      'cultureInfo' => $cultureInfo
    );
    $this->sendRequest($data, '/media/GetEstimatesIncident.php');
  }

  public function enableDebug($enabled = false)
  {
    $this->debug = $enabled;
  }

  protected function sendRequest($data, $endpoint)
  {
    $url = self::URL . $endpoint;

    $data['idClient'] = $this->idClient;
    $data['passKey']  = $this->passKey;
    $data = http_build_query($data);

    $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch,CURLOPT_USERAGENT,'EMT/5.3.5 CFNetwork/758.0.2 Darwin/15.0.0');
    curl_setopt($ch,CURLOPT_HTTPHEADER,
      array(
        'Accept-Language: es-es',
        'Accept: */*',
        'Accept-Encoding: gzip, deflate',
        'Content-Type: application/x-www-form-urlencoded'
      ));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
    curl_setopt($ch,CURLOPT_TIMEOUT, 20);
    $response = curl_exec($ch);

    if ($this->debug)
    {
      echo 'REQUEST: ' . $url . "\n";
      echo "RESPONSE: \n";
      print_r($response);
      echo "\n\n";
    }

    return json_decode($response, true);
  }
}
