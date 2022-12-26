<?php

namespace Gebageba\FirebaseDynamicLink;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

final class DynamicLinksClient implements DynamicLinksClientInterface
{
    public function __construct(
        private readonly string $endpoint,
        private readonly string $domainUriPrefix,
        private readonly string $androidPackageName,
        private readonly string $iosBundleId,
        private readonly string $iosAppStoreId
    )
    {
    }

    public function getShortLink(string $urlParameter): ResponseInterface
    {
        $httpClient = new Client();

        return $httpClient->request('POST', $this->endpoint, $this->params($urlParameter, 'SHORT'));
    }

    public function getUnguessableLink(string $urlParameter): ResponseInterface
    {
        $httpClient = new Client();

        return $httpClient->request('POST', $this->endpoint, $this->params($urlParameter, 'UNGUESSABLE'));
    }

    private function params(string $urlParameter, $option): array
    {
        return [
            'json' => [
                'dynamicLinkInfo' => [
                    'domainUriPrefix' => $this->domainUriPrefix,
                    'link' => $urlParameter,
                    'androidInfo' => [
                        'androidPackageName' => $this->androidPackageName,
                    ],
                    'iosInfo' => [
                        'iosBundleId' => $this->iosBundleId,
                        'iosAppStoreId' => $this->iosAppStoreId,
                    ],
                ],
                'suffix' => [
                    'option' => $option,
                ],
            ],
        ];
    }

    private function androidMinPackageVersionCode(string $version)
    {

    }
}
