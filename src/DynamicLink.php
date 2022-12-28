<?php


namespace Gebageba\FirebaseDynamicLink;

class DynamicLink implements DynamicLinkInterface
{
    private array $response;

    /**
     * @param string $endpoint
     * @param DynamicLinkParameter $dynamicLinkParameter
     */
    private function __construct(
        private readonly string               $endpoint,
        private readonly DynamicLinkParameter $dynamicLinkParameter,
    )
    {
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
     * @param string $endpoint
     * @param DynamicLinkParameter $dynamicLinkParameter
     * @return static
     */
    public static function generateDynamicLink(string $endpoint, DynamicLinkParameter $dynamicLinkParameter): self
    {
        $dynamicLink = new self($endpoint, $dynamicLinkParameter);
        $dynamicLink->generateLink(Suffix::UNGUESSABLE);
        return $dynamicLink;
    }

    /**
     * @param string $endpoint
     * @param DynamicLinkParameter $dynamicLinkParameter
     * @return static
     */
    public static function generateShortDynamicLink(string $endpoint, DynamicLinkParameter $dynamicLinkParameter): self
    {
        $dynamicLink = new self($endpoint, $dynamicLinkParameter);
        $dynamicLink->generateLink(Suffix::SHORT);
        return $dynamicLink;
    }

    /**
     * @param string $option
     * @return void
     */
    private function generateLink(string $option): void
    {
        $dynamicLinkClient = new DynamicLinksClient($this->endpoint, $this->dynamicLinkParameter);
        $response = $dynamicLinkClient->getResponse($option);

        $this->response = json_decode($response->getBody()->getContents(), true);
    }
}
