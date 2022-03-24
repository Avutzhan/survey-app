<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Survey extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    /**
     * @param $answer
     * @return void
     */
    public function incrementPoint($answer): void
    {
        $result = $answer->question->survey->total_point + $answer->point;
        $answer->question->survey->update(['total_point' => $result]);
    }
}
