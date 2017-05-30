<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 30.05.17
 */
require_once __DIR__."/../vendor/autoload.php";

$client = new \Nutnet\RKeeper7Api\Client(array(
    'server' => '127.0.0.1'
));


// получить информацию по карте
$client->call(new \Nutnet\RKeeper7Api\Requests\GetCardInfoRequest(array(
    'Is_Virtual_Card' => 'yes',
    'Image_Format' => array(
        'value' => 'JPEG',
        'attr' => array(
            'Original' => 'yes'
        ),
    ),
    'Account_Filter' => array(
        'children' => array(
            'Account_Class' => 2,
            'Account_Type_ID' => 1
        )
    )
)));

$client->call(new \Nutnet\RKeeper7Api\Requests\MakeTransactionRequest(array(
    // несколько элементов Transaction
    'Transaction' => array(
        array(
            'children' => array(
                'Account_ID' => 1
            )
        ),
        array(
            'children' => array(
                'Account_ID' => 2
            )
        ),
    )
)));

// вызвать асинхронно несколько методов
$client->callMulti(array(
    new \Nutnet\RKeeper7Api\Requests\MakeTransactionRequest(array(
        // несколько элементов Transaction
        'Transaction' => array(
            array(
                'children' => array(
                    'Account_ID' => 1
                )
            ),
            array(
                'children' => array(
                    'Account_ID' => 2
                )
            ),
        )
    )),
    new \Nutnet\RKeeper7Api\Requests\GetCardInfoRequest(array(
        'Is_Virtual_Card' => 'yes',
        'Image_Format' => array(
            'value' => 'JPEG',
            'attr' => array(
                'Original' => 'yes'
            ),
        ),
        'Account_Filter' => array(
            'children' => array(
                'Account_Class' => 2,
                'Account_Type_ID' => 1
            )
        )
    ))
));
