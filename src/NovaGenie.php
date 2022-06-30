<?php

namespace ElliottLawson\NovaGenie;

class NovaGenie
{
    public function __construct(
        protected $test,
    ) {
    }

    public static function wish($test): static
    {
        return new static($test);
    }

    public function verifyLens(string $lens): NovaLensGenie
    {
        return NovaLensGenie::wish($this->test)->forLens($lens);
    }

    public function accessingMenu(string $menu): NovaMenuGenie
    {
        return NovaMenuGenie::wish($this->test)->forMenu($menu);
    }

    public function usingFilter(string $filter): NovaFilterGenie
    {
        return NovaFilterGenie::wish($this->test)->forFilter($filter);
    }

    public function getFilterOptions(string $filter): array
    {
        return NovaFilterGenie::wish($this->test)->getOptions($filter);
    }
}
