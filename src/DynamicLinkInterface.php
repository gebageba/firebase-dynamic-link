<?php

namespace Gebageba\FirebaseDynamicLink;

interface DynamicLinkInterface
{
    public function value(): array;

    public function getShortLink(): string;

    public static function generateUnguessableDynamicLink(string $firebaseApiKey, DynamicLinkParameter $dynamicLinkParameter, string $dynamicLinkApi): self;

    public static function generateShortDynamicLink(string $dynamicLinkApi, string $firebaseApiKey, DynamicLinkParameter $dynamicLinkParameter): self;
}
