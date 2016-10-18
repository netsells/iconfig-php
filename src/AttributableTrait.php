<?php

namespace Netsells\iConfig;

use Illuminate\Support\Str;

trait AttributableTrait
{
    public function __call($method, $params)
    {
        if (starts_with($method, 'set')) {
            $attributeName = substr($method, 3, strlen($method));
            $this->setAttribute($attributeName, reset($params));
        }
    }

    /**
     * @param $attributeName
     * @param $value
     *
     * @return $this
     */
    protected function setAttribute($attributeName, $value)
    {
        $this->attributes[$this->formatAttributeName($attributeName)] = $value;

        return $this;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getAttribute($attributeName)
    {
        if (isset($this->attributes[$attributeName])) {
            return $this->attributes[$attributeName];
        }
    }

    protected function formatAttributeName($attributeName)
    {
        $attributeName = str_replace('SSL', 'Ssl', $attributeName);

        return Str::snake($attributeName);
    }
}