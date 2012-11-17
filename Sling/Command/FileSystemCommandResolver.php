<?php

namespace Sling\Command;

use \Sling\MVC\RequestInterface;

/**
 * @since 1.0
 */
class FileSystemCommandResolver implements CommandResolver
{
    protected $_default_command;

    const _NAMEPATH = '\Sling\Command\\';

    public function __construct($defaultCommand)
    {
        $this->_default_command = $defaultCommand;
    }

    public function getCommand(RequestInterface $request)
    {
        if ($request->hasParameter('cmd')) {
            $command_name = APPLICATION_PATH . DS . 'controller' . DS . $request->getParameter('cmd');
            $command = new $command_name;
            return $command;
        }

        require_once(APPLICATION_PATH . DS . 'controller' . DS .  $this->_default_command . '.php');
        $command = $this->_default_command . '_Controller';
        $command = new $command;
        return $command;
    }

}