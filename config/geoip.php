<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log settings for when a location is not found
    | for the IP provided.
    |
    */

    'log_failures' => true,

    /*
    |--------------------------------------------------------------------------
    | Include Currency in Results
    |--------------------------------------------------------------------------
    |
    | When enabled the system will do it's best in deciding the user's currency
    | by matching their ISO code to a preset list of currencies.
    |
    */

    'include_currency' => true,

    /*
    |--------------------------------------------------------------------------
    | Default Service
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default storage driver that should be used
    | by the framework using the services listed below.
    |
    */

    'service' => 'ipapi',

    /*
    |--------------------------------------------------------------------------
    | Storage Specific Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many storage drivers as you wish.
    |
    */

    'services' => [

        // 'maxmind_database' => [
        //     'class' => \Torann\GeoIP\Services\MaxMindDatabase::class,
        //     'database_path' => storage_path('app/geoip.mmdb'),
        //     'update_url' => sprintf('https://download.maxmind.com/app/geoip_download?edition_id=GeoLite2-City&license_key=%s&suffix=tar.gz', env('MAXMIND_LICENSE_KEY')),
        //     'locales' => ['en'],
        // ],

        // 'maxmind_api' => [
        //     'class' => \Torann\GeoIP\Services\MaxMindWebService::class,
        //     'user_id' => env('MAXMIND_USER_ID'),
        //     'license_key' => env('MAXMIND_LICENSE_KEY'),
        //     'locales' => ['en'],
        // ],

        // 'ipgeolocation' => [
        //     'class' => \Torann\GeoIP\Services\IPGeoLocation::class,
        //     'secure' => true,
        //     'key' => env('IPGEOLOCATION_KEY'),
        //     'continent_path' => storage_path('app/continents.json'),
        //     'lang' => 'en',
        // ],

        // 'ipdata' => [
        //     'class' => \Torann\GeoIP\Services\IPData::class,
        //     'key' => env('IPDATA_API_KEY'),
        //     'secure' => true,
        // ],

        // 'ipfinder' => [
        //     'class' => \Torann\GeoIP\Services\IPFinder::class,
        //     'key' => env('IPFINDER_API_KEY'),
        //     'secure' => true,
        //     'locales' => ['en'],
        // ],

        'ipapi' => [
            'class' => \Torann\GeoIP\Services\IPApi::class,
            'secure' => true, // pakai https
            'key' => null,    // kamu bisa isi kalau punya API key
            'locale' => 'en',
            'fields' => null,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Default Cache Driver
    |--------------------------------------------------------------------------
    |
    | Here you may specify the type of caching that should be used
    | by the package.
    |
    | Options:
    |
    |  all  - All location are cached
    |  some - Cache only the requesting user
    |  none - Disable cached
    |
    */

    'cache' => 'all',

    /*
    |--------------------------------------------------------------------------
    | Cache Tags
    |--------------------------------------------------------------------------
    |
    | Cache tags are not supported when using the file or database cache
    | drivers in Laravel. This is done so that only locations can be cleared.
    |
    */

    // 'cache_tags' => ['torann-geoip-location'],
    'cache_tags' => null,

    /*
    |--------------------------------------------------------------------------
    | Cache Expiration
    |--------------------------------------------------------------------------
    |
    | Define how long cached location are valid.
    |
    */

    'cache_expires' => 30,

    /*
    |--------------------------------------------------------------------------
    | Default Location
    |--------------------------------------------------------------------------
    |
    | Return when a location is not found.
    |
    */

    'default_location' => [
        'ip' => '127.0.0.0',
        'iso_code' => 'AU',
        'country' => 'Australia',
        'city' => 'Sydney',
        'state' => 'NSW',
        'state_name' => 'New South Wales',
        'postal_code' => '2000',
        'lat' => -33.8688,
        'lon' => 151.2093,
        'timezone' => 'Australia/Sydney',
        'continent' => 'OC',
        'default' => true,
        'currency' => 'AUD',
    ],

    // 'default_location' => [
    //     'ip' => '36.66.0.0', // IP publik Indonesia (contoh)
    //     'iso_code' => 'ID',
    //     'country' => 'Indonesia',
    //     'city' => 'Jakarta',
    //     'state' => 'JK',
    //     'state_name' => 'DKI Jakarta',
    //     'postal_code' => '10110',
    //     'lat' => -6.2088,
    //     'lon' => 106.8456,
    //     'timezone' => 'Asia/Jakarta',
    //     'continent' => 'AS',
    //     'default' => true,
    //     'currency' => 'IDR',
    // ],


];
