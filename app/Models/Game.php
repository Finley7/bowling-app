<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Game Model
 */
class Game extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'lane'
    ];

    /**
     * @return Game
     */
    public static function findMostRecent(): Game {
        return self::where('game_end', null)->firstOrFail();
    }

    /**
     * @return HasMany
     */
    public function players(): HasMany {
        return $this->hasMany(Player::class);
    }

    /**
     * @return HasMany
     */
    public function rounds() {
        return $this->hasMany(PlayerScore::class);
    }
}
