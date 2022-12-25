<?php

namespace Gebageba\FirebaseDynamicLink;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

final class DynamicLinksClient implements DynamicLinksClientInterface
{
//    private string $endpoint;
//    private string $domainUriPrefix;
//    private string $androidPackageName;
//    private string $iosBundleId;
//    private string $iosAppStoreId;

//        $this->endpoint = config('services.firebase.dynamic_links_api').config('services.firebase.api_key');
//        $this->domainUriPrefix = config('services.firebase.domain_uri_prefix');
//        $this->androidPackageName = config('services.firebase.android_package_name');
//        $this->iosBundleId = config('services.firebase.ios_bundle_id');
//        $this->iosAppStoreId = config('services.firebase.ios_app_store_id');

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

        return $httpClient->request('POST', $this->endpoint, $this->params($urlParameter));
    }

    private function params(string $urlParameter): array
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
                    'option' => 'SHORT',
                ],
            ],
        ];
    }
}
