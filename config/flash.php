<?php
return [

    /*
     * If true, all flash notifications will have an "x" to make them dismissible
     */
    'dismissible' => true,

    /**
     * Defines which css framework will be used. Allowed values are "tailwind" and "bootstrap"
     */
    'framework' => (string)env('FLASH_FRAMEWORK', 'tailwind'),

    /*
     * Extra class applied to each html alert notification
     */
    'class' => 'text-white',

    /**
     * Classes applied on each type of alert notification.
     */
    'classes' => [
        'tailwind' => [
            'info' => [
                'bg-color' => 'bg-blue-100',
                'border-color' => 'border-blue-400',
                'icon-color' => 'text-blue-400',
                'text-color' => 'text-blue-800',
                'icon' => 'fas fa-info-circle',
            ],
            'success' => [
                'bg-color' => 'bg-green-100',
                'border-color' => 'border-green-400',
                'icon-color' => 'text-green-400',
                'text-color' => 'text-green-800',
                'icon' => 'fas fa-check',
            ],
            'warning' => [
                'bg-color' => 'bg-yellow-100',
                'border-color' => 'border-yellow-400',
                'icon-color' => 'text-yellow-400',
                'text-color' => 'text-yellow-800',
                'icon' => 'fas fa-exclamation-circle',
            ],
            'error' => [
                'bg-color' => 'bg-red-100',
                'border-color' => 'border-red-400',
                'icon-color' => 'text-red-400',
                'text-color' => 'text-red-800',
                'icon' => 'fas fa-exclamation-triangle',
            ],
            'overlay' => [
                'overly-bg-color' => 'bg-gray-500',
                'overlay-bg-opacity' => 'opacity-75',

                'title-text-color' => 'text-gray-900',

                'body-text-color' => 'text-gray-500',

                'button-border-color' => 'border-transparent',
                'button-bg-color' => 'bg-indigo-600',
                'button-text-color' => 'text-white',

                'button-hover-bg-color' => 'hover:bg-indigo-700',
                'button-hover-text-color' => 'hover:text-white',
                'button-focus-ring-color' => 'focus:ring-indigo-500',

                'button-extra-classes' => '',

                'button-text' => 'Close',
            ],
        ],

        'bootstrap' => [
            'success' => 'alert-success',
            'error' => 'alert-danger',
            'warning' => 'alert-warning',
            'stored' => 'alert-success',
            'updated' => 'alert-success',
            'deleted' => 'alert-success',
            'queued' => 'alert-success',
        ],
    ],

    /*
     * Default messages used for all available actions
     */
    'messages' => [
        /*
         * Default success message
         */
        'success' => 'Operation executed successfully',

        /*
         * Default error message
         */
        'error' => 'An error occurred',

        /*
         * Default warning message
         */
        'warning' => 'Be careful',

        /*
         * Used when a new resource has been stored
         */
        'stored' => 'Stored successfully',

        /*
         * Used when an existing resource has been updated
         */
        'updated' => 'Updated successfully',

        /*
         * Used when a resource has been deleted
         */
        'deleted' => 'Deleted successfully',

        /*
         * Used when you want to notify that something has been pushed to queue
         */
        'queued' => 'Operation queued successfully',
    ],

    /*
     * The package can use the included generic error list view when a validation occurs
     */
    'validations' => [

        /*
         * Determine if the package will use the included validations errors view
         */
        'enabled' => false,

        /*
         * Path to errors view. Only available if "validations.enabled" is true.
         * This view can be published to adapt to your needs
         */
        'view' => 'flash::validations',

        /*
         * Class applied to alert validation box.
         */
        'classes' => [
            /**
             * Any tailwindcss class
             */
            'tailwind' => 'bg-red-600 text-white text-sm',

            /**
             * Should be any available bootstrap alert type: success, warning, danger, etc.
             */
            'bootstrap' => 'alert-danger',
        ],

        /*
         * Determine if alert validation will be dismissible
         */
        'dismissible' => true,

        /*
         * Extra class applied to alert validation
         */
        'class' => '',
    ]
];
