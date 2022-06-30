<?php

namespace ElliottLawson\NovaGenie;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class NovaFilterGenie extends BaseNovaGenie
{
    protected ?Filter $filter = null;

    protected ?string $option = null;

    protected ?Builder $query = null;

    protected Collection $results;

    public function forFilter(string $filter): self
    {
        $this->requireToBeInstanceOf(Filter::class, $filter);

        $this->filter = $filter::make();

        return $this;
    }

    public function on(Builder $builder): self
    {
        $this->query = $builder;

        return $this;
    }

    public function withOption(string $value): self
    {
        $this->option = $value;

        return $this;
    }

    public function apply(): self
    {
        throw_if(is_null($this->query), 'Pleas use "on()" to provide a query');

        throw_if(is_null($this->option), 'Please use "withOptions() to define an option');

        $this->results = $this->filter->apply(
            request: $this->getNovaRequest(),
            query: $this->query,
            value: $this->option,
        );

        return $this;
    }

    public function resultsIn(Closure $closure): static
    {
        $this->apply();

        $closure($this->results);

        return $this;
    }

    public function getResults(): Collection
    {
        return $this->results;
    }

    public function getOptions(string $filter): array
    {
        throw_unless(
            is_subclass_of($filter, Filter::class),
            'Please provide instance of ' . Filter::class,
        );

        return $filter::make()->options($this->getNovaRequest());
    }
}