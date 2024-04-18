<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlayerRequest;
use App\Models\Game;
use App\Models\Player;
use App\Models\PlayerScore;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * PlayerController
 */
class PlayerController extends Controller
{
    /**
     * @return View
     */
    public function welcome(): View {
        $game = Game::where('game_end', null)->first();

        return view('welcome')->with([
            'game' => $game
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request): RedirectResponse {

        $game = Game::create(['lane' => rand(1,12)]);

        foreach($request->all() as $key => $player) {
            if($key === '_token') {
                continue;
            }

            $player = Player::create([
                'name' => $player,
                'game_id' => $game->id
            ]);

            for($i = 0; $i < 10; ++$i) {
                PlayerScore::create([
                    'player_id' => $player->id,
                    'game_id' => $game->id,
                    'round' => $i +1
                ]);
            }
        }

        return redirect()->route('board.landing');
    }
}
