<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 30.05.17
 */

namespace Nutnet\RKeeper7Api\Requests;

use Nutnet\RKeeper7Api\Contracts\ResponseConverter as ResponseConverterInterface;

/**
 * Class RequestWithParamsAbstract
 *
 * @package Nutnet\RKeeper7Api\Requests
 */
abstract class RequestWithParamsAbstract extends RequestAbstract
{
    /**
     * @var array
     */
    protected $params;

    protected $responseConverter;

    /**
     * GetCardInfoRequest constructor.
     * @param array $params
     */
    public function __construct(array $params, ResponseConverterInterface $converter)
    {
        $this->params = $params;
        $this->responseConverter = $converter;
    }

    /**
     * @param \DOMElement $msg
     * @return void
     */
    public function buildMessageBody(\DOMElement $msg)
    {
        $this->arrayToXml($this->params, $msg);
    }

    public function getResponseConverter()
    {
      return $this->responseConverter;
    }
}
