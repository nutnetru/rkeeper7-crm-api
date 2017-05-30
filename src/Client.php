<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 30.05.17
 */

namespace Nutnet\RKeeper7Api;

use Guzzle\Http\Exception\MultiTransferException;
use Nutnet\RKeeper7Api\Contracts\ApiRequest;
use Guzzle\Http as Guzzle;
use Nutnet\RKeeper7Api\Contracts\ResponseConverter as ResponseConverterInterface;
use Nutnet\RKeeper7Api\Exceptions\RequestFailedException;

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
                // адрес сервера с api
                'server' => null,
                'port' => 80,
                // тип терминала
                'terminal_type' => 123,
                // идентификатор подразделения
                'unit_id' => 1,
                // идентификатор пользователя
                'user_id' => 1,
                // http://guzzle3.readthedocs.io/http-client/client.html#configuration-options
                'http_client_options' => null,
                // подготавливает ответ от апи перед передачей
                'response_converter' => new ResponseConverter()
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
                $this->createHttpRequest($request)->send()
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
     * Выполнить параллельно несколько запросов
     * @param array $requests
     * @return array
     * @throws RequestFailedException
     */
    public function callMulti(array $requests)
    {
        $context = $this;

        try {
            $responses = $this->getHttpClient()->send(
                array_map(
                    function ($apiReq) use ($context) {
                        return $context->createHttpRequest($apiReq);
                    },
                    $requests
                )
            );
        } catch (MultiTransferException $e) {
            $errorMessages = array_map(
                function ($err) {
                    return $err->getMessage();
                },
                $e->getIterator()->getArrayCopy()
            );

            throw new RequestFailedException(
                sprintf(
                    "Errors by sending request: %s",
                    implode('; ', $errorMessages)
                )
            );
        }

        return array_map(
            function ($response) use ($context) {
                return $context->convertResponse($response);
            },
            $responses
        );
    }

    /**
     * @param ApiRequest $request
     * @return Message
     */
    private function createBaseMessage(ApiRequest $request)
    {
        return new Message(
            array(
                'Terminal_Type' => $this->options['terminal_type'],
                'User_ID' => $this->options['user_id'],
                'Unit_ID' => $this->options['unit_id'],
                'Action' => $request->getAction(),
            ),
            $request
        );
    }

    /**
     * @param ApiRequest $request
     * @return Guzzle\Message\EntityEnclosingRequestInterface|Guzzle\Message\RequestInterface
     */
    private function createHttpRequest(ApiRequest $request)
    {
        return $this->getHttpClient()
            ->post(
                null,
                $request->getHeaders(),
                $this->createBaseMessage($request)->__toString(),
                $request->getOptions()
            );
    }

    /**
     * @param Guzzle\Message\Response $response
     * @return array|Guzzle\Message\Response
     */
    private function convertResponse(Guzzle\Message\Response $response)
    {
        $converter = $this->options['response_converter'];

        if ($converter instanceof ResponseConverterInterface) {
            return $converter->convert($response);
        }

        return $response;
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
            $this->options['server'],
            $this->options['http_client_options']
        );
    }
}
