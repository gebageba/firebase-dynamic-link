<?php

namespace Gebageba\FirebaseDynamicLink;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

final class DynamicLinksClient extends BaseBuilder implements DynamicLinksClientInterface
{
    private Client $httpClient;

    /**
     * @param string $endpoint
     * @param DynamicLinkParameter $dynamicLinkParameter
     */
    public function __construct(
        private readonly string               $endpoint,
        private readonly DynamicLinkParameter $dynamicLinkParameter
    ) {
        $this->httpClient = new Client();
    }

    /**
     * @param string $option
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getResponse(
        string $option
    ): ResponseInterface {
        return $this->httpClient->request('POST', $this->endpoint, $this->buildParameter($option));
    }

    /**
     * @param string $option
     * @return array
     */
    private function buildParameter(string $option): array
    {
        return [
            'json' => array_merge(['dynamicLinkInfo' => $this->dynamicLinkParameter->getData()], ['suffix' => ['option' => $option]])
        ];
    }
}
