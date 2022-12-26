<?php

namespace Gebageba\FirebaseDynamicLink;


final class DynamicLinkWithParameter implements DynamicLinkInterface
{
    private string $link;

    private function __construct(
        private readonly array $data,
        private readonly string $baseLink
    )
    {
    }

    public function value(): string
    {
        return $this->link;
    }

    public static function generateFromCampaign(array $data, string $baseLink): self
    {
        $dynamicLink = new self($data, $baseLink);
        $dynamicLink->generateLink();

        return $dynamicLink;
    }

    private function generateLink(): void
    {
        $additionalQuery = http_build_query($this->data); //必要か？？

        $this->link = $this->baseLink.'&'.$additionalQuery;
    }
}
