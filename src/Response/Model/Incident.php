<?php

namespace EMTMadrid\Response\Model;

use EMTMadrid\AutoPropertyHandler;

class Incident extends AutoPropertyHandler
{
    public $lastBuildDate;
    /**
     * @var IncidentList
     */
    public $incidentList;
}
