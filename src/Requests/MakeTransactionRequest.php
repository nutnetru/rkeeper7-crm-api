<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 30.05.17
 */

namespace Nutnet\RKeeper7Api\Requests;

/**
 * Class MakeTransactionRequest
 * @package Nutnet\RKeeper7Api\Requests
 */
class MakeTransactionRequest extends RequestWithParamsAbstract
{
    /**
     * @return string
     */
    public function getAction()
    {
        return 'Transaction';
    }
}
