<?php

namespace ElliottLawson\NovaGenie;

use Closure;
use ElliottLawson\NovaGenie\Concerns\GeneratesNovaRequests;
use ElliottLawson\NovaGenie\Concerns\Wishable;

class BaseNovaGenie
{
    use GeneratesNovaRequests;
    use Wishable;

    // use this for additional setup...like creating users and other data
    public function and(Closure $closure): self
    {
        $closure();

        return $this;
    }

    public function as(string|array $roles): self
    {
        // @Todo - is this still valid...?

        return $this;
    }

    protected function requireToBeInstanceOf(string $expected, string $actual): void
    {
        throw_unless(is_subclass_of($actual, $expected), "Genie demands instance of {$expected}");
    }
}