<?php

namespace ElliottLawson\NovaGenie;

use App\Nova\Lenses\Lens;
use ElliottLawson\NovaGenie\Concerns\WithLensHelper;
use ElliottLawson\NovaGenie\Concerns\WithLensVerifications;
use Illuminate\Support\Collection;

class NovaLensGenie extends BaseNovaGenie
{
    use WithLensHelper;
    use WithLensVerifications;

    protected Lens $lens;

    public function forLens(string $lens): self
    {
        $this->requireToBeInstanceOf(Lens::class, $lens);

        $this->lens = $lens::make();

        return $this;
    }

    // Use at your own risk...prerequisites may be required...
    public function getDataSetForResource(string $model): Collection
    {
        return $this->lens->query($this->getLensRequest(), $model::query())->get();
    }
}
