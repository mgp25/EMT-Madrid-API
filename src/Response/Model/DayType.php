<?php

namespace EMTMadrid\Response\Model;

use EMTMadrid\AutoPropertyHandler;

class DayType extends AutoPropertyHandler
{
    public $dayTypeId;
    /**
     * @var Direction
     */
    public $direction1;
    /**
     * @var Direction
     */
    public $direction2;
}
