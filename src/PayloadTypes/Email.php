<?php

namespace Netsells\iConfig\PayloadTypes;

use Netsells\iConfig\AttributableTrait;

class Email implements PayloadInterface
{
    use AttributableTrait;

    const AUTHENTICATION_PASSWORD = 'EmailAuthPassword';

    const TYPE_IMAP = 'EmailTypeIMAP';
    const TYPE_POP3 = 'EmailTypePOP';
}