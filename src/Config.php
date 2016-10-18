<?php

namespace Netsells\iConfig;

use Netsells\iConfig\PayloadTypes\PayloadInterface;

class Config
{

    protected $settings;

    protected $payloads = [];

    /**
     * @return array
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @param array $settings
     */
    public function setSettings(ConfigSettings $settings)
    {
        $this->settings = $settings;
    }

    public function addPayload(PayloadInterface $payload)
    {
        $this->payloads[] = $payload;
    }

    /**
     * @return array
     */
    public function getPayloads()
    {
        return $this->payloads;
    }

}