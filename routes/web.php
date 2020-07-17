<?php

use Dcat\Admin\Extension\Scheduling\Http\Controllers;

Route::get('scheduling', Controllers\SchedulingController::class.'@index')->name('scheduling-index');
Route::post('scheduling/run', Controllers\SchedulingController::class.'@runEvent')->name('scheduling-run');
