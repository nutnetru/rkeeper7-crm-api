<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 31.05.17
 */

namespace Nutnet\RKeeper7Api\Tests;

use Guzzle\Http\Message\Response;
use Nutnet\RKeeper7Api\ResponseConverter;

/**
 * Class ResponseConverterTest
 * @package Nutnet\RKeeper7Api\Tests
 */
class ResponseConverterTest extends BaseTestCase
{
    /**
     * @dataProvider dpConvert
     * @param $responseBody
     * @param $errorExpected
     * @see ResponseConverter::convert()
     */
    public function testConvert($responseBody, $errorExpected)
    {
        $response = new Response(200, null, $responseBody);
        $converter = new ResponseConverter();

        if ($errorExpected) {
            $this->setExpectedException($errorExpected);
        }

        $this->assertInstanceOf('\SimpleXmlElement', $converter->convert($response));
    }

    /**
     * @return array
     */
    public function dpConvert()
    {
        return array(
            array(
                file_get_contents($this->getDataFilePath('data_1.xml')),
                null,
            ),
            array(
                file_get_contents($this->getDataFilePath('data_2.xml')),
                null,
            ),
            array(
                file_get_contents($this->getDataFilePath('data_wrong_xml.xml')),
                'Nutnet\RKeeper7Api\Exceptions\CantReadResponseException'
            ),
        );
    }
}
