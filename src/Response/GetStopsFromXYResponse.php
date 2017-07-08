<?php

namespace EMTMadrid\Response;

use EMTMadrid\AutoPropertyHandler;

class GetStopsFromXYResponse extends AutoPropertyHandler
{
    /**
     * @var float
     */
    public $longitude;
    /**
     * @var float
     */
    public $latitude;
    /**
     * @var Model\Stop[]
     */
    public $stop;
}
