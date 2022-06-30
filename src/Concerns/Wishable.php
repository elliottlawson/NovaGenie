<?php

namespace ElliottLawson\NovaGenie\Concerns;

trait Wishable
{
    public function __construct(
        protected $test,
    ) {
    }

    public static function wish($test): self
    {
        return new static($test);
    }
}
