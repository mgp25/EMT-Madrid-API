<?php

namespace EMTMadrid\Response\Model;

use EMTMadrid\AutoPropertyHandler;

class Arrive extends AutoPropertyHandler
{
    public $stopId;
    public $lineId;
    public $isHead;
    public $destination;
    public $busId;
    public $busTimeLeft;
    public $busDistance;
    /**
     * @var float
     */
    public $longitude;
    /**
     * @var float
     */
    public $latitude;
    public $busPositionType;
}
