<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 30.05.17
 */

namespace Nutnet\RKeeper7Api\Requests;

/**
 * Class GetCardInfoRequest
 * @package Nutnet\RKeeper7Api\Requests
 */
class EditHolderRequest extends RequestWithParamsAbstract
{
    /**
     * @return string
     */
    public function getAction()
    {
        return 'Edit holders';
    }
}
