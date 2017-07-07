<?php

namespace EMTMadrid\Response;

use EMTMadrid\AutoPropertyHandler;

class EstimatesIncidentResponse extends AutoPropertyHandler
{
    public $errorCode;
    public $description;
    /**
     * @var Model\Arrives
     */
    public $arrives;
    /**
     * @var Model\Incident
     */
    public $incident;
}
