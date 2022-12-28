<?php

namespace Gebageba\FirebaseDynamicLink;

interface DynamicLinkParameterInterface
{
    public static function for(string $domain, string $link): self;

    public function withoutAppPreviewPage(): self;

    public function withAndroid(AndroidInfo $info): self;

    public function withIOS(IOSInfo $info): self;
}
