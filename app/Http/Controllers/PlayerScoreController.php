<?php

namespace App\Http\Controllers;

use App\Helper\BowlingGameHelper;
use App\Http\Requests\SubmitPlayerScoreRequest;
use App\Models\PlayerScore;
use Illuminate\Http\RedirectResponse;

/**
 * PlayerScoreController
 */
class PlayerScoreController extends Controller
{
    /**
     * @param SubmitPlayerScoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(SubmitPlayerScoreRequest $request): RedirectResponse {

        $score = $request->validated();
        $helper = new BowlingGameHelper();

        $helper->roll($score);

        return redirect()->to('/board');

    }
}
