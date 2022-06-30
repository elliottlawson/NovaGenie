<?php

use ElliottLawson\NovaGenie\NovaGenie;
use ElliottLawson\NovaGenie\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

function novaGenie(): NovaGenie
{
    return NovaGenie::wish(test());
}
