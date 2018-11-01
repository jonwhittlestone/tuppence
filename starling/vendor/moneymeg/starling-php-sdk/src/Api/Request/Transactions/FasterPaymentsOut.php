<?php

namespace Starling\Api\Request\Transactions;

use Starling\Api\Request;
use Starling\Api\Request\Transactions;

class FasterPaymentsOut extends Transactions
{
    /**
     * Whats our endpoint
     *
     * @var string
     */
    protected $endpoint = "transactions/fps/out";
}
