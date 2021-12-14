<?php

use App\Models\Timeslot;
use Illuminate\Http\Request;
use App\Http\Resources\MovieResource;
use App\Http\Resources\PerformerMovieResource;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\TimeslotResource;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Builder;

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
            ->whereHas('genres', fn (Builder $query) => $query->where('title', $request->genre))
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

Route::get('/specific_movie_theater', function (Request $request) {
    
    // validate theatre_name, d_date

    return TimeslotResource::collection(
        Timeslot::whereHas('theatre', fn (Builder $query) => $query->where('name', $request->theater_name))
            ->whereDate('start_time', $request->d_date)
            ->with('movie')
            ->get()
    );
});

Route::get('/search_performer', function (Request $request) {
    
    // validate performer_name

    return PerformerMovieResource::collection(
        Movie::whereHas('performers', fn (Builder $query) => $query->where('name', $request->performer_name))
            ->get()
    );
});

// add rating 
// should i use event sourcing ?

Route::get('/new_movies', function (Request $request) {
    
    // validate r_date

    return PerformerMovieResource::collection(
        Movie::whereDate('releaseDate', '>=', $request->r_date)
            ->get()
    );
});

// add movie