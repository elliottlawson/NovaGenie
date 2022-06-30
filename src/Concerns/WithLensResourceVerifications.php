<?php

namespace ElliottLawson\NovaGenie\Concerns;

use Illuminate\Support\Collection;
use ReflectionProperty;

trait WithLensResourceVerifications
{
    protected function matchLensResource($actual, LensResource $expected): void
    {
        $this->test::assertEquals(
            static::getLensResourceProperties($expected),
            static::getLensResourceProperties($actual),
        );
    }

    protected function doesntMatchAnyLensResource(LensResource $lens): void
    {
        // This isn't very efficient
        // We should only have assertions for the items passed rather than for the universe of resources
        $this->getAuthorizedLensResources()->each(function($expected) use ($lens) {
            $this->test::assertNotEquals(
                static::getLensResourceProperties($expected),
                static::getLensResourceProperties($lens),
            );
        });
    }

    protected static function getLensResourceProperties(LensResource $lensResource): array
    {
        $resource = new ReflectionProperty(LensResource::class, 'resource');
        $resource->setAccessible(true); // Removable after php 8.1 min support

        $lens = new ReflectionProperty(LensResource::class, 'lens');
        $lens->setAccessible(true); // Removable after php 8.1 min support

        $label = new ReflectionProperty(LensResource::class, 'label');
        $label->setAccessible(true); // Removable after php 8.1 min support

        return [
            'resource' => $resource->getValue($lensResource),
            'lens' => $lens->getValue($lensResource),
            'label' => $label->getValue($lensResource),
        ];
    }

    protected function getAuthorizedLensResources(): Collection
    {
        return collect($this->menu->resources())
            ->filter(fn ($resource) => $resource->authorizedToSee($this->getNovaRequest()));
    }
}