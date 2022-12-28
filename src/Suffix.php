<?php

/*
 * This file is part of Firebase-Dynamic-Link.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gebageba\FirebaseDynamicLink;

class Suffix extends SimpleBuilder
{
    public const SHORT = 'SHORT';
    public const UNGUESSABLE = 'UNGUESSABLE';

    public function __construct($option)
    {
        parent::__construct(compact('option'));
    }
}
