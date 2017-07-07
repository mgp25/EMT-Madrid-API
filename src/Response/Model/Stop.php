<?php

namespace EMTMadrid\Response\Model;

use EMTMadrid\AutoPropertyHandler;

class Stop extends AutoPropertyHandler
{
    public $stopId;
    public $name;
    public $postalAddress;
    /**
     * @var float
     */
    public $longitude;
    /**
     * @var float
     */
    public $latitude;
    public $lineId;
}
