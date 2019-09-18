<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 30.05.17
 */

namespace Nutnet\RKeeper7Api;

use GuzzleHttp\Psr7\Response;
use Nutnet\RKeeper7Api\Contracts\ResponseConverter as ResponseConverterInterface;
use Nutnet\RKeeper7Api\ResponseConverter;

/**
 * Class ResponseConverter
 * @package Nutnet\RKeeper7Api
 */
class CateglistResponseConverter extends ResponseConverter implements ResponseConverterInterface
{

  /**
   * @param \GuzzleHttp\Psr7\Response $response
   *
   * @return mixed|\SimpleXMLElement
   * @throws \Nutnet\RKeeper7Api\Exceptions\CantReadResponseException
   */
  public function convert(Response $response)
  {
    $data = [];

    //Преобразуем ответ в SimpleXMLElement
    $xml = parent::convert($response);

    return $data;
  }
}
