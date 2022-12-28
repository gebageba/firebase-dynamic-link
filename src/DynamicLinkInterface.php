<?php

/*
 * This file is part of Firebase-Dynamic-Link.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gebageba\FirebaseDynamicLink;

interface DynamicLinkInterface
{
    public function value(): array;

    public function getShortLink(): string;

    public static function generateUnguessableDynamicLink(string $firebaseApiKey, DynamicLinkParameter $dynamicLinkParameter, string $dynamicLinkApi): self;

    public static function generateShortDynamicLink(string $firebaseApiKey, DynamicLinkParameter $dynamicLinkParameter, string $dynamicLinkApi): self;
}
