<?php

declare(strict_types=1);

use MarekZelezny\Plausible\Plausible;

if (! function_exists('plausible')) {
    function plausible(string $key = null): Plausible|string|array|null
    {
        if ($key === null) {
            return app('plausible');
        }

        return app('plausible')->get($key);
    }
}
