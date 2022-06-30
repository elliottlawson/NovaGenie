<?php

namespace ElliottLawson\NovaGenie\Concerns;

use Illuminate\Foundation\Testing\TestCase;

trait Wishable
{
    public function __construct(
        protected $test,
    ) {}

    public static function wish($test): self
    {
        return new static($test);
    }
}