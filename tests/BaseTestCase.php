<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 31.05.17
 */

namespace Nutnet\RKeeper7Api\Tests;

/**
 * Class BaseTestCase
 * @package Nutnet\RKeeper7Api\Tests
 */
abstract class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        \Mockery::close();
    }

    /**
     * @param $file
     * @return string
     */
    protected function getDataFilePath($file)
    {
        $namespace = __NAMESPACE__;
        $class = str_replace(
            '\\',
            '_',
            trim(str_replace($namespace, '', get_called_class()), '\\')
        );

        return __DIR__.'/_data/'.$class.'/'.$file;
    }
}
