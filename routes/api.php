<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'api',
        'middleware' => ['api', 'auth:api'],
    ],
    function () {
        Route::group(
            [
                'namespace' => '\InetStudio\SchedulePackage\Slots\Presentation\Http\Controllers\Api',
                'prefix' => 'module/schedule',
            ],
            function () {
                Route::get('slots', 'ItemsController@getSlots')
                    ->name('api.schedule.slots');

                Route::post('slots/reserve', 'ItemsController@reserveSlot')
                    ->name('api.schedule.slots.reserve');
            }
        );
    }
);
