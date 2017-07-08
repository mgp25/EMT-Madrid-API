<?php

namespace EMTMadrid\Response;

use EMTMadrid\AutoPropertyHandler;

class GetNodesLinesResponse extends AutoPropertyHandler
{
    public $resultCode;
    public $resultDescription;
    /**
     * @var Model\ResultValues[]
     */
    public $resultValues;
}
