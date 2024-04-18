<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PlayerScoreController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PlayerController::class, 'welcome'])->name('player.welcome');

Route::post('/create-players', [PlayerController::class, 'save'])->name('player.save');
Route::post('/submit-score', [PlayerScoreController::class, 'save'])->name('player-score.save');

Route::get('/board', [BoardController::class, 'landing'])->name('board.landing');
Route::get('/game-end', [BoardController::class, 'finish'])->name('board.finish');
Route::get('/end', [BoardController::class, 'end'])->name('board.end');
