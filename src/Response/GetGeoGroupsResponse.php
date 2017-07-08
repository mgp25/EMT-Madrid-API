<?php

namespace EMTMadrid\Response;

use EMTMadrid\AutoPropertyHandler;

class GetGeoGroupsResponse extends AutoPropertyHandler
{
    public $resultCode;
    public $resultDescription;
    /**
     * @var Model\ResultValues[]
     */
    public $resultValues;
}
