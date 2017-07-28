<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 30.05.17
 */

namespace Nutnet\RKeeper7Api\Requests;

use Nutnet\RKeeper7Api\Contracts\ApiRequest;

/**
 * Class RequestAbstract
 * @package Nutnet\RKeeper7Api\Requests
 */
abstract class RequestAbstract implements ApiRequest
{
    /**
     * @inheritdoc
     */
    public function getHeaders()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getOptions()
    {
        return array();
    }

    /**
     * @param array $arr
     * @param \DOMElement $parent
     */
    protected function arrayToXml(array $arr, \DOMElement $parent)
    {
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                if (is_int(current(array_keys($value)))) {
                    foreach ($value as $node) {
                        $this->arrayToXml(array(
                            $key => $node
                        ), $parent);
                    }
                    continue;
                }

                $child = $parent->ownerDocument->createElement(
                    $key,
                    isset($value['value']) ? $value['value'] : null
                );

                if (isset($value['attr'])) {
                    $this->setNodeAttributes($value['attr'], $child);
                }

                if (isset($value['children'])) {
                    $this->arrayToXml($value['children'], $child);
                }
            } else {
                $child = $parent->ownerDocument->createElement($key, $value);
            }

            $parent->appendChild($child);
        }
    }

    /**
     * @param array $attributes
     * @param \DOMElement $el
     */
    private function setNodeAttributes(array $attributes, \DOMElement $el)
    {
        foreach ($attributes as $name => $val) {
            $el->setAttribute($name, $val);
        }
    }
}
