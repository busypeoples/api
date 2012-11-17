<?php

namespace Sling\MVC;

interface RequestInterface {
    public function setController($controller);
    public function getController();
    public function setMethod($method);
    public function getMethod();
    public function setParameter($request_vars);
    public function setData($data);
    public function getData();
    public function getHttpAccept();
    public function getParameterNames();
    public function getParameter($key);
    public function hasParameter($key);
}
