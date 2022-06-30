<?php

namespace ElliottLawson\NovaGenie\Concerns;

use laravel\Nova\Http\Requests\LensRequest; // @Todo - refine

trait WithLensHelper
{
    protected ?LensRequest $lensRequest = null;

    protected function getLensRequest(): LensRequest
    {
        return $this->lensRequest ??= resolve(LensRequest::class);
    }

    protected function getListOfFields(): array
    {
        return collect($this->lens->fields($this->getNovaRequest()))
            ->map(fn ($field) => field::class)
            ->toArray();
    }

    protected function getListOfFilters(): array
    {
        return collect($this->lens->filters($this->getNovaRequest()))
            ->map(fn ($field) => field::class)
            ->toArray();
    }

    protected function getListOfActions(): array
    {
        return collect($this->lens->actions($this->getNovaRequest()))
            ->map(fn ($field) => field::class)
            ->toArray();
    }

    protected function getListOfCards(): array
    {
        return collect($this->lens->cards($this->getNovaRequest()))
            ->map(fn ($field) => field::class)
            ->toArray();
    }
}
