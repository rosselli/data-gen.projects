<?php

use App\Http\Controllers\Records as Records;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('rosselli:raw-data {profile : name of the profile [ex.: PeopleBasic]} {records : number of records you want to generate}', function ($profile, $records) {
    $records = new Records($records);
    $profile = "App\\Http\\Controllers\\Profiles\\".$profile;
    $p = new $profile($records);
    $this->info(json_encode($p->getData()));

})->describe('Raw Data in json generated for a given profile');
