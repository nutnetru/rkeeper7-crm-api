<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 30.05.17
 */

namespace Nutnet\RKeeper7Api;

use Guzzle\Http\Message\Response;
use Nutnet\RKeeper7Api\Contracts\ResponseConverter as ResponseConverterInterface;

/**
 * Class ResponseConverter
 * @package Nutnet\RKeeper7Api
 */
class ResponseConverter implements ResponseConverterInterface
{
    /**
     * @inheritdoc
     */
    public function convert(Response $response)
    {
        $xml = simplexml_load_string($response->getBody(true));

        return $this->xmlToArray($xml);
    }

    /**
     * @param \SimpleXMLElement $xml
     * @return array
     */
    private function xmlToArray(\SimpleXMLElement $xml)
    {
        $result = array();
        foreach ($xml as $key => $el) {
            /** @var \SimpleXMLElement $el */
            $result[$key] = $el->count() ? $this->xmlToArray($el) : (string)$el;
        }

        return $result;
    }
}
