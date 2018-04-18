<?php

namespace Leavingstone\MessagingApi\Util;

class ResponseObject {
    public function __construct($method, $messageId, $response, $errorCode = 0) {
        $this->method = $method;
        $this->messageId = $messageId;
        $this->errorCode = $errorCode;
        $this->response = $response;
    }

    public function get() {
        $obj = [
            'method'    => $this->method,
            'params'    => $this->response,
            'messageId' => $this->messageId,
            'type'      => 1,
            'errorCode' => $this->errorCode
        ];

        if ($this->errorCode > 0) {
            $obj['errorDescription'] = $this->response;
            $obj['params'] = new \stdClass();
        }

        return $obj;
    }
}