<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static findOrFail($id)
 */
class Answer extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * @param $answer
     * @return void
     */
    public function checkPoints($answer): void
    {
        if (!empty($answer->point)) {
            $answer->question->survey->incrementPoint($answer);
        }
    }
}
