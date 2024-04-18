<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 */
class PlayerScore extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'round', 'score_1','score_2','player_id','game_id','total_score'
    ];

    /**
     * @return BelongsTo
     */
    public function player(): BelongsTo {
        return $this->belongsTo(Player::class);
    }

    /**
     * @return BelongsTo
     */
    public function game(): BelongsTo {
        return $this->belongsTo(Game::class);
    }
}
