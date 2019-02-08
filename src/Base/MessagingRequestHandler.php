<?php

namespace Leavingstone\MessagingApi\Base;

use App\MessagingApi\MethodsEnum;
use Illuminate\Http\Request;
use Leavingstone\MessagingApi\Contracts\MessagingApiMethodInterface;
use Leavingstone\MessagingApi\Util\ResponseObject;

class MessagingRequestHandler
{

    protected $contract;
    protected $response;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $methodContract = MethodsEnum::getMethod($request->get('method'));
        $this->contract = $methodContract;
        $instance = $methodContract->getClassName();

        $this->factory(new $instance($request, $methodContract));
    }

    protected function isAssoc(array $arr)
    {
        if (array() === $arr) {
            return false;
        }
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    public function factory(MessagingApiMethodInterface $method)
    {
        $result = $method->handle();
        $response = (new ResponseObject($this->contract->getResponseNumber(), $this->request->get('messageId'),
            $result))->get();
        $this->response = $response;
    }

    public function getResponseObject()
    {
        return $this->response;
    }
}