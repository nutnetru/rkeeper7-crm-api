<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 30.05.17
 */

namespace Nutnet\RKeeper7Api\Contracts;

/**
 * Interface ApiRequest
 * @package Nutnet\RKeeper7Api\Contracts
 */
interface ApiRequest
{
    /**
     * @return string
     */
    public function getAction();

    /**
     * @param \DOMElement $msg
     * @return void
     */
    public function buildMessageBody(\DOMElement $msg);

    /**
     * @return array|null
     */
    public function getHeaders();

    /**
     * @return array|null
     */
    public function getOptions();
}
