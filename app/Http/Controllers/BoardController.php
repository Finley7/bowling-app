<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\PlayerScore;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * BoardController
 */
class BoardController extends Controller
{
    /**
     * @return View
     */
    public function landing(): View|RedirectResponse {

        $game = Game::findMostRecent();

        if ($game->state == 11) {
            return redirect()->to('/end');
        }

        $inTurn = $game->rounds()
            ->where('round', $game->state)
            ->where(static function ($query) {
                $query->whereNull('score_1')->orWhereNull('score_2');
            })
            ->first();

        if ($inTurn === null) {
            // Increment the round
            ++$game->state;
            $game->save();
            return redirect()->to('/board');
        }

        return view('board')->with([
            'game' => $game,
            'turn' => $inTurn,
        ]);
    }

    /**
     * @return View
     */
    public function end(): View {

        return view('end')->with([
            'game' => Game::findMostRecent()
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function finish(): RedirectResponse {
        $game = Game::findMostRecent();
        $game->game_end = time();
        $game->save();

        return redirect()->to('/');
    }
}
