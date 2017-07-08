<?php

namespace EMTMadrid;

use EMTMadrid\Exception;
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
            'User-Agent'        => Constants::USER_AGENT,
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
            Debug::printRequest('POST', $endpoint);
            Debug::printUpload(Utils::formatBytes(strlen($data)));
            Debug::printPostData($data);
            $bytes = Utils::formatBytes($response->getHeader('Content-Length')[0]);
            Debug::printHttpCode($response->getStatusCode(), $bytes);
            Debug::printResponse($body, $this->truncatedDebug);
        }

        if ($body === '[false]') {
            throw new Exception\EMTMadridException('Llamada no disponible en este momento.');
            return;
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
