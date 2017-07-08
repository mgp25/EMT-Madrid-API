<?php

namespace EMTMadrid\Response;

use EMTMadrid\AutoPropertyHandler;

class GetStopsFromStopResponse extends AutoPropertyHandler
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
