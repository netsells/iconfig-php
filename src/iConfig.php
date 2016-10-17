<?php

namespace Netsells\iConfig;

class iConfig
{
    public function submitConfig(Config $config)
    {
        echo "<pre>";
        var_dump($config);
        die();
    }
}