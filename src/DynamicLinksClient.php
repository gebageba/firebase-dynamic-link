<?php

/*
 * This file is part of Firebase-Dynamic-Login.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gebageba\FirebaseDynamicLink;

use Gebageba\FirebaseDynamicLink\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

final class DynamicLinksClient implements DynamicLinksClientInterface
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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getResponse(
        string $option
    ): ResponseInterface {
        try {
            return $this->httpClient->request('POST', $this->endpoint, $this->buildParameter($option));
        } catch (ClientException $exception) {
            throw new GuzzleException($exception->getMessage(), $exception->getCode());
        }
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
