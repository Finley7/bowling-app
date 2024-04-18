<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Player model
 */
class Player extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'game_id'
    ];

    /**
     * @return HasMany
     */
    public function scores(): HasMany {
        return $this->hasMany(PlayerScore::class);
    }
}
