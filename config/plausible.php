<?php

return [

    /**
     * Domain name of your Plausible Analytics
     */
    'domain' => env('PLAUSIBLE_DOMAIN', 'example.com'),

    /**
     * Enable tracking for several types of goals
     */
    'tracking' => [
        'pageview_properties' => env('PLAUSIBLE_TRACKING_PAGEVIEW_PROPS', false),

        /**
         * These features require creating custom goals in Plausible Analytics
         */
        'outbound_link_clicks' => env('PLAUSIBLE_TRACKING_OUTBOUND_LINK_CLICKS', false),
        'file_downloads' => env('PLAUSIBLE_TRACKING_FILE_DOWNLOADS', false),
    ],
];
