<?php

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