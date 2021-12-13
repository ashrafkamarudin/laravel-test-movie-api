<?php

use App\Http\Resources\MovieCollection;
use App\Http\Resources\MovieResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    $genre = $request->get('genre');

    return response()->json(
        MovieResource::collection(
            \App\Models\Movie::with('genres')
                ->whereHas('genres', fn (\Illuminate\Database\Eloquent\Builder $query) => $query->where('title', $genre))
                ->get()
        )
    );
});

Route::get('/genre', function (Request $request) {
    $genre = $request->get('genre');

    return response()->json(
        MovieResource::collection(
            \App\Models\Movie::with('genres')
                ->whereHas('genres', fn (\Illuminate\Database\Eloquent\Builder $query) => $query->where('title', $genre))
                ->get()
        )
    );
});