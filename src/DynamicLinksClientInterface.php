<?php

/*
 * This file is part of Firebase-Dynamic-Link.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gebageba\FirebaseDynamicLink;

use Psr\Http\Message\ResponseInterface;

interface DynamicLinksClientInterface
{
    public function getResponse(string $option): ResponseInterface;
}
