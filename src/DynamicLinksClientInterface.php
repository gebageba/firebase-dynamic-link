<?php

namespace Gebageba\FirebaseDynamicLink;

use Psr\Http\Message\ResponseInterface;

interface DynamicLinksClientInterface
{
    public function getResponse(string $option): ResponseInterface;
}
