<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('api/web/get-web-areas', 'AreaApiController@getWebAreas');
