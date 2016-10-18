<?php

namespace Netsells\iConfig\Helpers;

use Illuminate\Support\Str;
use Netsells\iConfig\Config;

class Flatten
{
    public function config(Config $config)
    {
        $configs = [];

        foreach($config->getPayloads() as $payload) {
            $configs[Str::snake(class_basename($payload))][] = $payload->getAttributes();
        }

        return [
            'configs' => $configs,
            'settings' => $config->getSettings()->getAttributes(),
        ];
    }
}