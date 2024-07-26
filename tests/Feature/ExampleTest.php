<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\GuzzleException;
use Tresor\Flexpay\FlexPayClient;
use Tresor\Flexpay\Exception\PaymentErrorException;

it('processes payment successfully', function () {
    $mockClient = Mockery::mock(Client::class);
    $mockClient->shouldReceive('post')
        ->once()
        ->andReturn(new Response(200, [], json_encode(['status' => 'success'])));

    $client = new FlexPayClient($mockClient, 'test_api_key', 'https://api.example.com');

    $data = new \Tresor\Flexpay\Data\CardPaymentData(
        'XXXXXXX',
        'KNXXXXX',
        '1',
        \Tresor\Flexpay\Data\Currency::USD->value,
        'http://xxxxxxxxxx/callback',
    );

    $response = $client->process($data->toJson());

    expect($response)->toBeArray()->toHaveKey('status', 'success');
});

it('throws PaymentErrorException on failure', function () {
    $mockClient = Mockery::mock(Client::class);
    $mockClient->shouldReceive('post')
        ->once()
        ->andThrow(new class extends \Exception implements GuzzleException {});

    $client = new FlexPayClient($mockClient, 'test_api_key', 'https://api.example.com');

    $data = new \Tresor\Flexpay\Data\CardPaymentData(
        'XXXXXXX',
        'KNXXXXX',
        '1',
        \Tresor\Flexpay\Data\Currency::USD->value,
        'http://xxxxxxxxxx/callback',
    );


    $response = $client->process($data->toJson());

    expect($response)->toBeInstanceOf(PaymentErrorException::class);
});
