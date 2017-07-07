<?php

namespace EMTMadrid;

use GuzzleHttp\Client as GuzzleClient;

class HttpInterface
{
    protected $debug;
    protected $truncatedDebug;

    public function setDebug($bool)
    {
        $this->debug = $bool;
    }

    public function setTruncatedDebug($bool)
    {
        $this->truncatedDebug = $bool;
    }


    public function sendRequest(
        $data,
        $endpoint,
        $class)
    {
        $url = Constants::BASE_URL . $endpoint;

        $data['idClient'] = Constants::ID_CLIENT;
        $data['passKey']  = Constants::PASS_KEY;
        $data = http_build_query($data);

        $headers =
        [
            'User-Agent'        => 'EMT/5.3.5 CFNetwork/758.0.2 Darwin/15.0.0',
            'Content-Type'      => 'application/x-www-form-urlencoded',
            'Accept-Encoding'   => 'gzip, deflate',
            'Accept-Language'   => 'es-es',
            'Accept'            => '*/*'
        ];

        $options =
        [
            'headers'   => $headers,
            'body'      => $data
        ];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, $options);
        $body = $response->getBody()->getContents();

        if ($this->debug) {
            echo 'Request: ' . $endpoint . "\n";
            echo 'Response: '.$body."\n";
            echo "\n\n";
        }

        $mapper = new \JsonMapper();
        return $mapper->map(self::api_body_decode($body), $class);
    }

    public static function api_body_decode(
        $json,
        $assoc = false)
    {
        return json_decode($json, $assoc, 512, JSON_BIGINT_AS_STRING);
    }
}
