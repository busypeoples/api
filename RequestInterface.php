<?php

namespace Sling;

interface RequestInterface {
    public function setController($controller);
    public function getController();
    public function setMethod($method);
    public function getMethod();
    public function setRequestVars($request_vars);
    public function setData($data);
    public function getData();
    public function getHttpAccept();
    public function getRequestVars();
    public function getRequestVar($key);
    public function hasRequestVar($key);
}
