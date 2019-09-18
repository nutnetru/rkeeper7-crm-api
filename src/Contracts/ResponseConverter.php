<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 30.05.17
 */

namespace Nutnet\RKeeper7Api\Contracts;

use GuzzleHttp\Psr7\Response;

/**
 * Interface ResponseConverter
 * @package Nutnet\RKeeper7Api\Contracts
 */
interface ResponseConverter
{
    /**
     * @param Response $response
     * @return mixed
     */
    public function convert(Response $response);
}
