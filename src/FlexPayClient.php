<?php

declare(strict_types=1);

namespace Tresor\Flexpay;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Tresor\Flexpay\Data\ProcessPaymentInterface;
use Tresor\Flexpay\Exception\PaymentErrorException;

final class FlexPayClient implements ProcessPaymentInterface
{
    /**
     * @param Client $client
     * @param string $apiKey
     * @param string $baseUrl
     */
    public function __construct(
        protected Client $client,
        protected string $apiKey,
        protected string $baseUrl
    ){}

    /**
     * @param string $data
     * @return array|void|PaymentErrorException|mixed
     */
    public function process(string $data): mixed
    {
        try {
            $response = $this->client->post($this->baseUrl, [
                'headers' => [
                    'Authorization' => "Bearer $this->apiKey",
                    'Content-Type' => 'application/json',
                ],
                'json' => $data,
            ]);

            $result = json_decode($response->getBody()->getContents(), true);

            if ($result['code'] === "0") {
                if (isset($result['url'])) {
                    header('Location: ' . $result['url']);
                    exit();
                } else {
                    return [
                        'message' => $result['message'],
                        'order_transaction_number' => $result['orderNumber'],
                    ];
                }
            }
        } catch (GuzzleException $exception) {
            return new PaymentErrorException(
                "An error occurred while processing the payment: " . $exception->getMessage(),
            );
        }

        return [
            'message' => 'Payment processing failed',
            'code' => $result['code'] ?? 'unknown',
        ];
    }
}
