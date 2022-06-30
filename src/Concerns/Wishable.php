<?php

namespace ElliottLawson\NovaGenie\Concerns;

use Illuminate\Foundation\Testing\TestCase;

trait Wishable
{
    public function __construct(
        protected TestCase $test,
    ) {}

    public static function wish(TestCase $test): self
    {
        return new static($test);
    }
}