<?php

namespace EMTMadrid\Response\Model;

use EMTMadrid\AutoPropertyHandler;

class Line extends AutoPropertyHandler
{
    public $lineId;
    public $label;
    public $headerA;
    public $headerB;
    /**
     * @var DayType[]
     */
    public $dayType;
}
