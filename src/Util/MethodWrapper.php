<?php

namespace Leavingstone\MessagingApi\Util;

class MethodWrapper {
    protected  $method;
    public function __construct(array $methodArray) {
        $this->method = $methodArray;
    }
    public function getClassName() {
        return $this->method['className'];
    }
    public function getResponseNumber() {
        return $this->method['responseMethod'];
    }
}