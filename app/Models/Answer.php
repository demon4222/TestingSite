<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Answer
 *
 * @property int $id
 * @property string $text
 * @property int $question_id
 * @property int $isCorrect
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Question $question
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereIsCorrect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Answer extends Model
{
    protected $fillable = ['text', 'question_id', 'is_correct'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
