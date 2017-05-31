<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 31.05.17
 */

namespace Nutnet\RKeeper7Api\Tests;

use Nutnet\RKeeper7Api\Message;

/**
 * Class MessageTest
 * @package Nutnet\RKeeper7Api\Tests
 */
class MessageTest extends BaseTestCase
{
    /**
     * @see Message::__toString()
     */
    public function testToString()
    {
        $apiRequest = \Mockery::mock('Nutnet\RKeeper7Api\Contracts\ApiRequest');
        $apiRequest->shouldReceive('buildMessageBody')->once();

        $message = new Message(
            array(
                'User_ID' => 5
            ),
            $apiRequest
        );

        $expected = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Message User_ID="5"/>';

        $this->assertEquals($expected, trim($message->__toString()));
    }
}
