<?php

use App\Http\Actions\Balance\CheckBalanceAction;
use App\Http\Actions\Checkin\CheckinAction;
use App\Http\Actions\Consume\ConsumeAction;
use App\Http\Actions\OpenTap\OpenTapAction;
use App\Http\Actions\RouteCheck\GlobalCheckAction;
use App\Http\Actions\RouteCheck\LivenessProbeAction;
use App\Http\Actions\RouteCheck\ReadnessProbeAction;
use App\Http\Actions\Tabs\CloseAllAction;
use App\Http\Actions\Tabs\CloseTabsAction;
use App\Http\Actions\Tabs\ListTabAction;
use App\Http\Actions\Tabs\ListTabsAction;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::prefix('enjoy')->group(function(){

    Route::get('/balance', CheckBalanceAction::class);
    Route::post('/open', OpenTapAction::class);
    Route::post('/consume', ConsumeAction::class);

});

Route::prefix('enjoy')->middleware('jwt')->group(function () {

    Route::post('/checkin', CheckinAction::class);
    Route::get('/tabs', ListTabsAction::class);
    Route::get('/tab/{tab}', ListTabAction::class);
    Route::delete('/tab/{tab}/close', CloseTabsAction::class);
    Route::delete('/tab/close/all', CloseAllAction::class);
});

Route::prefix('probe')->group(function(){
    Route::get('/readness', ReadnessProbeAction::class);
    Route::get('/liveness', LivenessProbeAction::class);
    Route::post('/global', GlobalCheckAction::class);
    Route::get('/global', GlobalCheckAction::class);
});
