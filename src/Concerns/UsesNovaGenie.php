<?php

namespace ElliottLawson\NovaGenie\Concerns;

use ElliottLawson\NovaGenie\NovaGenie;

trait UsesNovaGenie
{
    public function novaGenie(): NovaGenie
    {
        return NovaGenie::wish($this);
    }
}
