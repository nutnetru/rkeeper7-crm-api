<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 30.05.17
 */

namespace Nutnet\RKeeper7Api;

use Guzzle\Http\Message\Response;
use Nutnet\RKeeper7Api\Contracts\ResponseConverter as ResponseConverterInterface;
use Nutnet\RKeeper7Api\Exceptions\CantReadResponseException;

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
        @$xml = simplexml_load_string($response->getBody(true));

        if (false === $xml) {
            throw new CantReadResponseException('Error parsing xml response');
        }

        return $xml;
    }
}
