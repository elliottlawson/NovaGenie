<?php

namespace ElliottLawson\NovaGenie\Concerns;

trait WithLensVerifications
{
    public function hasFields(array $fields): self
    {
        $this->test->assertEqualsCanonicalizing($this->getListOfFields(), $fields);

        return $this;
    }

    public function hasFilters(array $filters): self
    {
        $this->test->assertEqualsCanonicalizing($this->getListOfFilters(), $filters);

        return $this;
    }

    public function hasActions(array $actions): self
    {
        $this->test->assertEqualsCanonicalizing($this->getListOfActions(), $actions);

        return $this;
    }

    public function hasCards(array $cards): self
    {
        $this->test->assertEqualsCanonicalizing($this->getListOfCards(), $cards);

        return $this;
    }

    public function hasUriKey(string $uriKey): self
    {
        $this->test->assertSame($this->lens->uriKey(), $uriKey);

        return $this;
    }

    public function hasName(string $name): self
    {
        $this->test->assertSame($this->lens->name(), $name);

        return $this;
    }
}