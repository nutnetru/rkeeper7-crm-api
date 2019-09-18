<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 30.05.17
 */

namespace Nutnet\RKeeper7Api;

use Guzzle\Http\Exception\MultiTransferException;
use Nutnet\RKeeper7Api\Contracts\ApiRequest;
use GuzzleHttp as Guzzle;
use Nutnet\RKeeper7Api\Contracts\ResponseConverter as ResponseConverterInterface;
use Nutnet\RKeeper7Api\Exceptions\RequestFailedException;
use Nutnet\RKeeper7Api\Exceptions\ClientResponseConverterNotSetException;

/**
 * Class Client
 * @package Nutnet\RKeeper7Api
 */
class Client
{
    /**
     * @var array
     */
    private $options;

    /**
     * @var Guzzle\Client
     */
    private $httpClient;

    /**
     * Client constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->options = array_merge(
            array(
                'server' => null,
                'uri' => '/',
                'http_client_options' => null,
            ),
            $options
        );
    }

    /**
     * Выполнить один запрос
     * @param ApiRequest $request
     * @return array|Guzzle\Message\Response
     * @throws RequestFailedException
     */
    public function call(ApiRequest $request)
    {
        try {
            return $this->convertResponse(
              $this->createHttpRequest($request),
              $request->getResponseConverter()
            );
        } catch (Guzzle\Exception\RequestException $e) {
            throw new RequestFailedException(
                sprintf(
                    "Errors by sending request: %s",
                    $e->getMessage()
                )
            );
        }
    }

    /**
     * @param ApiRequest $request
     * @return Message
     */
    private function createBaseMessage(ApiRequest $request)
    {
        return new Message(
            array(),
            $request
        );
    }

    /**
     * @param ApiRequest $request
     * @return Guzzle\Message\EntityEnclosingRequestInterface|Guzzle\Message\RequestInterface
     */
    private function createHttpRequest(ApiRequest $request)
    {
        $http_client =  $this->getHttpClient();
        $response =  $http_client->post($this->options['uri'], [
          'body' => $this->createBaseMessage($request)->__toString()
        ]);

        return $response;
    }

    /**
     * @param \GuzzleHttp\Psr7\Response $response
     * @return array|GuzzleHttp\Psr7\Response
     */
    private function convertResponse(\GuzzleHttp\Psr7\Response $response, ResponseConverterInterface $converter)
    {
      return $converter->convert($response);
    }

    /**
     * @return Guzzle\Client
     */
    private function getHttpClient()
    {
        if ($this->httpClient) {
            return $this->httpClient;
        }

        return $this->httpClient = new Guzzle\Client(
            [
              'base_uri' => $this->options['server'],
              'auth' => $this->options['http_client_options']['auth']
            ]
        );
    }
}
