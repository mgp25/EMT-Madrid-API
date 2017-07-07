<?php

namespace EMTMadrid\Response;

use EMTMadrid\AutoPropertyHandler;

class StopsLineResponse extends AutoPropertyHandler
{
    /**
     * @var Model\Line[]
     */
    public $Line;
    public $lineId;
    public $label;
    public $destination;
    public $incidents;
    /**
     * @var Model\Stop[]
     */
    public $stop;
}
