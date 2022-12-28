<?php

namespace Gebageba\FirebaseDynamicLink;

class BaseBuilder
{
    private array $data;

    protected function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return static
     */
    protected function with(string $key, $value): static
    {
        $copy = clone $this;
        $copy->data[$this->key][$key] = $value;
        return $copy;
    }

    /**
     * @param self $builder
     * @return static
     */
    protected function merge(self $builder): static
    {
        $new = clone $this;
        $new->data = array_merge($this->data, $builder->data);
        return $new;
    }

    protected function getData(): array
    {
        return $this->data;
    }
}