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
    )
    {
        $this->client = new Client();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function process(array $data): mixed
    {
        try {
            $response = $this->client->post($this->baseUrl, [
                'headers' => [
                    'Authorization' => "Bearer $this->apiKey",
                    'Content-Type' => 'application/json',
                ],
                'json' => $data,
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return new PaymentErrorException(
                "An error occurred while processing the payment : $e->getMessage()",
            );
        }
    }
}
