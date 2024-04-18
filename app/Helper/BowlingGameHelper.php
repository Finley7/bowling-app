<?php

namespace App\Helper;

use App\Models\PlayerScore;
use Illuminate\Http\RedirectResponse;

/**
 * BowlingGameHelper
 */
class BowlingGameHelper
{
    /**
     * @param $score
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function roll($score): RedirectResponse|null
    {
        $playerScore = PlayerScore::find($score['score_id']);

        if ($playerScore->score_1 === null && $score['score'] == 10) {
            $playerScore->score_1 = 10;
            $playerScore->score_2 = 0;
        } else {
            if ($playerScore->score_1 !== null && ($playerScore->score_1 + $score['score']) > 10) {
                flash('Het is niet mogelijk boven ' . (10 - $playerScore->score_1) . ' punten te scoren');
                return redirect()->to('/board');
            }

            if ($playerScore->score_1 !== null) {
                $playerScore->score_2 = $score['score'];
            } else {
                $playerScore->score_1 = $score['score'];
            }
        }

        $playerScore->save();

        $this->calculateTotalScores($playerScore->player_id, $playerScore->game_id);
        return null;
    }

    /**
     * @param int $playerId
     * @param int $gameId
     * @return void
     */
    private function calculateTotalScores(int $playerId, int $gameId): void
    {
        $playerScores = PlayerScore::where('player_id', $playerId)
            ->where('game_id', $gameId)
            ->whereNotNull('score_1')
            ->orderBy('round')
            ->get();

        $prevScore = 0;

        foreach ($playerScores as $index => $playerScore) {
            $playerScore->total_score = $prevScore + $playerScore->score_1 + $playerScore->score_2;

            if ($playerScore->score_1 === 10 || $playerScore->score_1 + $playerScore->score_2 === 10) {
                $nextFrame = PlayerScore::where('player_id', $playerScore->player_id)
                    ->where('game_id', $playerScore->game_id)
                    ->where('round', $playerScore->round + 1)
                    ->whereNotNull('score_1')
                    ->first();

                if ($nextFrame) {
                    $playerScore->total_score += $nextFrame->score_1 + ($nextFrame->score_2 !== null ? $nextFrame->score_2 : 0);
                }
            }

            $playerScore->save();
            $prevScore = $playerScore->total_score;
        }
    }
}
