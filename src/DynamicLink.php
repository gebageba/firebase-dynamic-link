<?php


namespace Gebageba\FirebaseDynamicLink;

use GuzzleHttp\Exception\GuzzleException;

class DynamicLink implements DynamicLinkInterface
{
    private string $endpoint;
    private array $response;

    /**
     * @param string $dynamicLinkApi
     * @param string $firebaseApiKey
     * @param DynamicLinkParameter $dynamicLinkParameter
     */
    private function __construct(
        string                                $dynamicLinkApi,
        string                                $firebaseApiKey,
        private readonly DynamicLinkParameter $dynamicLinkParameter,
    )
    {
        $this->endpoint = $dynamicLinkApi.'?key='.$firebaseApiKey;
    }

    /**
     * @return array
     */
    public function value(): array
    {
        return $this->response;
    }

    /**
     * @return string
     */
    public function getShortLink(): string
    {
        return $this->response['shortLink'];
    }

    /**
     * @param string $firebaseApiKey
     * @param DynamicLinkParameter $dynamicLinkParameter
     * @param string $dynamicLinkApi
     * @return static
     * @throws GuzzleException
     */
    public static function generateUnguessableDynamicLink(string $firebaseApiKey, DynamicLinkParameter $dynamicLinkParameter, string $dynamicLinkApi = 'https://firebasedynamiclinks.googleapis.com/v1/shortLinks'): self
    {
        $dynamicLink = new self($dynamicLinkApi, $firebaseApiKey, $dynamicLinkParameter);
        $dynamicLink->generateLink(Suffix::UNGUESSABLE);
        return $dynamicLink;
    }

    /**
     * @param string $dynamicLinkApi
     * @param string $firebaseApiKey
     * @param DynamicLinkParameter $dynamicLinkParameter
     * @return static
     * @throws GuzzleException
     */
    public static function generateShortDynamicLink(string $dynamicLinkApi, string $firebaseApiKey, DynamicLinkParameter $dynamicLinkParameter): self
    {
        $dynamicLink = new self($dynamicLinkApi, $firebaseApiKey, $dynamicLinkParameter);
        $dynamicLink->generateLink(Suffix::SHORT);
        return $dynamicLink;
    }

    /**
     * @param string $option
     * @return void
     * @throws GuzzleException
     */
    private function generateLink(string $option): void
    {
        $dynamicLinkClient = new DynamicLinksClient($this->endpoint, $this->dynamicLinkParameter);
        $response = $dynamicLinkClient->getResponse($option);

        $this->response = json_decode($response->getBody()->getContents(), true);
    }
}
