<?php

declare(strict_types=1);

namespace Xvilo\CrtShApi;

use DateTimeImmutable;
use Exception;
use Generator;
use Http\Client\Common\HttpMethodsClient;
use Http\Client\Exception as PsrClientException;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Message\RequestFactory;
use Http\Message\StreamFactory;
use JsonException;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Xvilo\CrtShApi\Model\SearchResult;

final class CrtSh
{
    private HttpClient $httpClient;
    private ?RequestFactoryInterface $requestFactory;
    private ?StreamFactoryInterface $streamFactory;
    private HttpMethodsClient $httpMethodsClient;

    public function __construct(
        HttpClient $httpClient = null,
        RequestFactory $requestFactory = null,
        StreamFactory $streamFactory = null
    ) {
        $this->httpClient = $httpClient ?? HttpClientDiscovery::find();
        $this->requestFactory = $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = $streamFactory ?? Psr17FactoryDiscovery::findStreamFactory();
    }

    private function getHttpClient(): HttpMethodsClient
    {
        if (!isset($this->httpMethodsClient)) {
            $this->httpMethodsClient = new HttpMethodsClient(
                $this->httpClient,
                $this->requestFactory
            );
        }

        return $this->httpMethodsClient;
    }

    /**
     * @throws PsrClientException
     * @throws JsonException
     * @throws Exception
     */
    public function search(
        string $search,
        bool $excludeExpired = true
    ): Generator {
        $uri = sprintf('https://crt.sh/?q=%s&output=json', urlencode($search));
        if ($excludeExpired) {
            $uri .= '&exclude=expired';
        }

        $response = $this->getHttpClient()->get($uri);
        $data = json_decode($response->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR);

        foreach ($data as $item) {
            yield new SearchResult(
                $item['id'],
                $item['issuer_ca_id'],
                $item['issuer_name'],
                $item['common_name'],
                $item['name_value'],
                new DateTimeImmutable($item['entry_timestamp']),
                new DateTimeImmutable($item['not_before']),
                new DateTimeImmutable($item['not_after']),
                $item['serial_number'],
            );
        }
    }
}
