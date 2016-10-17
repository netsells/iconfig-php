<?php

namespace Netsells\iConfig;

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
        $this->attributes[$attributeName] = $value;

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
}