<?php

namespace GetThingsDone\Affiliate;

use Illuminate\Support\Facades\Facade;

/**
 * @see \GetThingsDone\Affiliate\Affiliate
 */
class AffiliateFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Affiliate::class;
    }
}
