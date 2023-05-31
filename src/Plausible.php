<?php

declare(strict_types=1);

namespace MarekZelezny\Plausible;

class Plausible
{
    protected string $domain;

    protected string $trackingUrl;

    protected array $tracking;

    protected array $simpleProperties = [];

    protected array $arrayProperties = [];

    public function __construct()
    {
        $this->domain = config('plausible.domain');
        $this->tracking = config('plausible.tracking');
        $this->trackingUrl = $this->trackingUrl();
    }

    public function trackingUrl(): string
    {
        $src = 'https://plausible.io/js/script.manual';

        if ($this->tracks('pageview_properties')) {
            $src .= '.pageview-props';
        }

        if ($this->tracks('outbound_link_clicks')) {
            $src .= '.outbound-links';
        }

        if ($this->tracks('file_downloads')) {
            $src .= '.file-downloads';
        }

        $src .= '.js';

        return $src;
    }

    public function tracks(string $key): bool
    {
        return $this->tracking[$key] ?? false;
    }

    public function property(string $key, string|array $value): self
    {
        if (is_array($value)) {
            foreach ($value as $v) {
                $this->arrayProperties[][$key] = $v;
            }
        } else {
            $this->simpleProperties[$key] = $value;
        }

        return $this;
    }

    public function properties(string $property = null): array
    {
        return match ($property) {
            'simple' => $this->get('simpleProperties'),
            'array' => $this->get('arrayProperties'),
            default => array_merge(
                $this->get('simpleProperties'),
                $this->get('arrayProperties')
            ),
        };
    }

    public function get(string $key): string|array|null
    {
        return $this->$key ?? null;
    }
}
