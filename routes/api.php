<?php

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Timeslot;
use App\Models\Performer;
use Illuminate\Http\Request;
use App\Actions\CreateNewMovie;
use App\Http\Resources\MovieResource;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\TimeslotResource;
use App\Http\Requests\CreateMovieRequest;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\GetMovieByGenreRequest;
use App\Http\Resources\PerformerMovieResource;
use App\Http\Requests\GetMovieBySpecificPerformer;
use App\Http\Requests\GetMovieReleaseAfterSpecificDateRequest;
use App\Http\Requests\GetMovieTimeslotOnSpecificTheatreOnSpecificDateRequest;
use App\Http\Requests\GetMovieTimeslotOnSpecificTheatreWithinTimeframeRequest;
use App\Http\Requests\GiveRatingRequest;

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

Route::get('/genre', fn (GetMovieByGenreRequest $request) => MovieResource::collection(
    \App\Models\Movie::with('genres')
        ->whereHas('genres', fn (Builder $query) => $query->where('title', $request->genre))
        ->get()
));

Route::get('/timeslot', fn (GetMovieTimeslotOnSpecificTheatreWithinTimeframeRequest $request) => TimeslotResource::collection(
    Timeslot::whereBetween('start_time', [$request->time_start, $request->time_end])
        ->whereHas('theatre', fn (Builder $query) => $query->where('name', $request->theatre_name))
        ->with('movie')
        ->get()
));

Route::get('/specific_movie_theater', fn (GetMovieTimeslotOnSpecificTheatreOnSpecificDateRequest $request) => TimeslotResource::collection(
    Timeslot::whereHas('theatre', fn (Builder $query) => $query->where('name', $request->theatre_name))
        ->whereDate('start_time', $request->d_date)
        ->with('movie')
        ->get()
));

Route::get('/search_performer', fn (GetMovieBySpecificPerformer $request) => PerformerMovieResource::collection(
    Movie::whereHas('performers', fn (Builder $query) => $query->where('name', $request->performer_name))
        ->get()
));

// add rating 
// should i use event sourcing ?

Route::post('/give_rating', function (GiveRatingRequest $request) {
    $rating = Movie::whereTitle($request->movie_title)->first()->ratings()->create(
        $request->except(['movie_title'])
    );

    if ($rating) {
        return response()->json([
            'message' => sprintf("Successfully added review for %s by user: %s", $request->movie_title, $request->username),
            'success' => true
        ]);
    }
});

Route::get('/new_movies', fn (GetMovieReleaseAfterSpecificDateRequest $request) => PerformerMovieResource::collection(
    Movie::whereDate('releaseDate', '>=', $request->r_date)->get()
));

Route::post('/add_movie', function (CreateMovieRequest $request, CreateNewMovie $createNewMovie) {

    $movie = $createNewMovie->create($request->toArray());

    $movie->genres()->sync(
        Genre::whereIn('title', $request->genres)->get(['id'])->pluck('id')
    );

    $movie->performers()->sync(
        Performer::whereIn('name', $request->performers)->get(['id'])->pluck('id')
    );

    if ($movie) {
        return response()->json([
            'message' => sprintf("Successfully added movie %s with Movie_ID %d", $movie->title, $movie->id),
            'success' => true
        ]);
    }
});
