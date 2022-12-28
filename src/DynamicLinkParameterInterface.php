<?php

/*
 * This file is part of Firebase-Dynamic-Link.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gebageba\FirebaseDynamicLink;

interface DynamicLinkParameterInterface
{
    public static function for(string $domainUriPrefix, string $link): self;

    public function withoutAppPreviewPage(): self;

    public function withAndroid(AndroidInfo $info): self;

    public function withIOS(IOSInfo $info): self;
}
