<?php

namespace Gebageba\FirebaseDynamicLink;

interface DynamicLinkInterface
{
    public function value(): array;

    public function getShortLink(): string;

    public static function generateDynamicLink(string $endpoint, DynamicLinkParameter $dynamicLinkParameter): self;

    public static function generateShortDynamicLink(string $endpoint, DynamicLinkParameter $dynamicLinkParameter): self;
}
