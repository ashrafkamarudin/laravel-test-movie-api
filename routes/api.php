<?php

use App\Models\Timeslot;
use Illuminate\Http\Request;
use App\Http\Resources\MovieResource;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\TimeslotResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/genre', function (Request $request) {

    // validate genre

    return MovieResource::collection(
        \App\Models\Movie::with('genres')
            ->whereHas('genres', fn (\Illuminate\Database\Eloquent\Builder $query) => $query->where('title', $request->genre))
            ->get()
    );
});

Route::get('/timeslot', function (Request $request) {
    
    // validate theatre_name, time_start, time_end

    return TimeslotResource::collection(
        Timeslot::whereBetween('start_time', [$request->time_start, $request->time_end])
            ->with('movie')
            ->get()
    );
});