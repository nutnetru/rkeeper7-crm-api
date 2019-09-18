<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 30.05.17
 */

namespace Nutnet\RKeeper7Api;

use GuzzleHttp\Psr7\Response;
use Nutnet\RKeeper7Api\Contracts\ResponseConverter as ResponseConverterInterface;
use Nutnet\RKeeper7Api\Exceptions\CantReadResponseException;

/**
 * Class ResponseConverter
 * @package Nutnet\RKeeper7Api
 */
class ResponseConverter implements ResponseConverterInterface
{

  /**
   * @param \GuzzleHttp\Psr7\Response $response
   *
   * @return mixed|\Nutnet\RKeeper7Api\Contracts\SimpleXMLElement|\SimpleXMLElement
   * @throws \Nutnet\RKeeper7Api\Exceptions\CantReadResponseException
   */
    public function convert(Response $response)
    {
        @$xml = simplexml_load_string($response->getBody()->getContents());

        if (false === $xml) {
            throw new CantReadResponseException('Error parsing xml response');
        }

        return $xml;
    }
}
