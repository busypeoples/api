<?php

namespace Sling\Command;

use Sling\MVC\RequestInterface;

/**
 *
 * @abstract
 */
interface CommandResolver
{
    public function getCommand(RequestInterface $request);
}