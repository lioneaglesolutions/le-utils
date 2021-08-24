<?php

namespace Lioneagle\LeUtils;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lioneagle\LeUtils\LeUtils
 */
class LeUtilsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'le-utils';
    }
}
