<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 30.05.17
 */

namespace Nutnet\RKeeper7Api;

use Nutnet\RKeeper7Api\Contracts\ApiRequest;
use Nutnet\RKeeper7Api\Contracts\RequestMessage;

/**
 * Class Message
 * @package Nutnet\RKeeper7Api
 */
class Message implements RequestMessage
{
    /**
     * @var array
     */
    private $messageAttr;

    /**
     * @var ApiRequest
     */
    private $request;

    /**
     * Message constructor.
     * @param array $messageAttr
     * @param ApiRequest $request
     */
    public function __construct(array $messageAttr, ApiRequest $request)
    {
        $this->messageAttr = $messageAttr;
        $this->request = $request;
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        $doc = new \DOMDocument('1.0', 'UTF-8');
        $doc->formatOutput = true;
        $doc->xmlStandalone = true;

        $msg = $doc->createElement('RK7Query');
        foreach ($this->messageAttr as $attrName => $attrValue) {
            $msg->setAttribute($attrName, $attrValue);
        }

        $this->request->buildMessageBody($msg);

        $doc->appendChild($msg);

        return $doc->saveXML();
    }
}
