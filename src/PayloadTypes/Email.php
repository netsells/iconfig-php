<?php

namespace Netsells\iConfig\PayloadTypes;

use Netsells\iConfig\AttributableTrait;

class Email implements PayloadInterface
{
    use AttributableTrait;

    const AUTHENTICATION_PASSWORD = 'password';
}