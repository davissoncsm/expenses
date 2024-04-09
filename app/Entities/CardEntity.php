<?php

namespace App\Entities;

use Database\Factories\CardFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardEntity extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'cards';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'number',
        'limit',
    ];

    /**
     * Scope a query to only include filter by user if user authenticated is not admin.
     */
    public function scopeUserFilter(Builder $query): void
    {
        $query->when(!auth()->user()->is_admin, function($builder) {
            $builder->where('user_id', auth()->user()->id);
        });
    }

    /**
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return CardFactory::new();
    }

    /**
     * @return HasMany
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(ExpenseEntity::class, 'card_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(USerEntity::class, 'user_id', 'id');
    }
}
