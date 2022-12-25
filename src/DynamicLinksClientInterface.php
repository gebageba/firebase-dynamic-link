<?php

namespace Gebageba\FirebaseDynamicLink;

use Psr\Http\Message\ResponseInterface;

interface DynamicLinksClientInterface
{
    public function getShortLink(string $urlParameter): ResponseInterface;
}
