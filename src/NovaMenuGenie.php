<?php

namespace ElliottLawson\NovaGenie;

use ElliottLawson\NovaGenie\Concerns\WithLensResourceVerifications;

class NovaMenuGenie extends BaseNovaGenie
{
    use WithLensResourceVerifications;

    protected Menu|TopLevelResource $menu;

    public function forMenu(string $menu): static
    {
        $this->requireToBeInstanceOf(Menu::class, $menu);

        $this->menu = $menu::make();

        return $this;
    }

    public function isVisible(): static
    {
        $this->test::assertTrue(
            $this->menu->authorizedToSee($this->getNovaRequest())
        );

        return $this;
    }

    public function isNotVisible(): static
    {
        $this->test::assertFalse(
            $this->menu->authorizedToSee($this->getNovaRequest())
        );

        return $this;
    }

    public function availableResourcesShouldBe(array $expected): static
    {
        $resources = $this->getAuthorizedLensResources();

        collect($expected)->each(function (LensResource $item) use ($resources) {
            $resource = $resources->shift();

            if ($resource instanceof LensResource === false) {
                $this->test::assertFalse(true, 'We do not have handling for that resource yet.');
            }

            $this->matchLensResource($resource, $item);
        });

        return $this;
    }

    public function availableResourcesShouldNotBe(array $expected): static
    {
        collect($expected)->each(function ($item) {
            if ($item instanceof LensResource === false) {
                $this->test::assertFalse(true, 'We do not have handling for that resource yet.');
            }

            $this->doesntMatchAnyLensResource($item);
        });

        return $this;
    }
}