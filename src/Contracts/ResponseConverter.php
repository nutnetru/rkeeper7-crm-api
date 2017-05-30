<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 30.05.17
 */

namespace Nutnet\RKeeper7Api\Contracts;

use Guzzle\Http\Message\Response;

/**
 * Interface ResponseConverter
 * @package Nutnet\RKeeper7Api\Contracts
 */
interface ResponseConverter
{
    /**
     * @param Response $response
     * @return array
     */
    public function convert(Response $response);
}
