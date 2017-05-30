<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 30.05.17
 */

namespace Nutnet\RKeeper7Api\Requests;

/**
 * Class GetTransactionsInfoRequest
 * @package Nutnet\RKeeper7Api\Requests
 */
class GetTransactionsInfoRequest extends RequestWithParamsAbstract
{
    /**
     * @return string
     */
    public function getAction()
    {
        return 'Get transactions info';
    }
}
