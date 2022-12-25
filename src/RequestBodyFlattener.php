<?php

namespace Gebageba\FirebaseDynamicLink;

final class RequestBodyFlattener
{
    private string $value;

    public function __construct($body)
    {
        $objBody = array_merge(array(), $body);
        $flatPair = [];
        foreach ($objBody as $key => $value) {
            if (is_int($value))
                $value = strval($value);
            if (is_array($value)) {
                $allSubKeys = [];
                foreach ($value as $elem) {
                    $allSubKeys += array_keys($elem);
                }
                foreach ($value as $elem) {
                    foreach ($allSubKeys as $subKey) {
                        $flatKey = "{$key}.{$subKey}";
                        $flatRawValue = $elem[$subKey] ? $elem[$subKey] : "";
                        $prevFlatValue = $flatPair[$flatKey];
                        $flatPair[$flatKey] =
                            is_null($prevFlatValue) ? $flatRawValue : "{$prevFlatValue},{$flatRawValue}";
                    }
                }
            } else {
                $flatPair[$key] = $value;
            }
        }
        ksort($flatPair);
        $flattenBody = [];
        foreach ($flatPair as $key => $value) {
            array_push($flattenBody, "{$key}={$value}");
        }
        $this->value = join("&", $flattenBody);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}
