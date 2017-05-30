<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 30.05.17
 */

namespace Nutnet\RKeeper7Api\Requests;

/**
 * Class RequestWithParamsAbstract
 * @package Nutnet\RKeeper7Api\Requests
 */
abstract class RequestWithParamsAbstract extends RequestAbstract
{
    /**
     * @var array
     */
    protected $params;

    /**
     * GetCardInfoRequest constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * @param \DOMElement $msg
     * @return void
     */
    public function buildMessageBody(\DOMElement $msg)
    {
        $this->arrayToXml($this->params, $msg);
    }
}
