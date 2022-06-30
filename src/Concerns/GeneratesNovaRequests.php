<?php

namespace ElliottLawson\NovaGenie\Concerns;

// Needs refined
use Laravel\Nova\Http\Requests\NovaRequest;

trait GeneratesNovaRequests
{
    protected ?NovaRequest $novaRequest = null;

    protected function getNovaRequest(): NovaRequest
    {
        return $this->novaRequest ??= $this->generateNovaRequest();
    }

    protected function generateNovaRequest(): NovaRequest
    {
        $request = resolve(NovaRequest::class);

        if (isset($this->user)) {
            $request->setUserResolver(fn () => $this->user);
        }

        return $request;
    }

    protected function regenerateNovaRequest(): self
    {
        $this->novaRequest = $this->generateNovaRequest();

        return $this;
    }

    protected function updateRequestUser(User $user): self
    {
        $this->novaRequest = $this->novaRequest->setUserResolver(fn () => $user);

        return $this;
    }
}
