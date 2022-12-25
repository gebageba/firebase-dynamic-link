<?php

namespace Gebageba\FirebaseDynamicLink;


final class DynamicLinkWithParameter implements DynamicLinkInterface
{
    private string $link;

//$this->baseLink = config('services.firebase.base_link');
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
        $query = (new RequestBodyFlattener($this->data))->value();
        $this->link = $this->baseLink.'?'.$query;
    }
}
