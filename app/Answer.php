<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Parsedown;

class Answer extends Model
{

    use VotableTrait;

    protected $fillable= ['body', 'user_id'];

    protected $appends= ['created_date'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getBodyHtmlAttribute()
    {
        return clean(Parsedown::instance()->text($this->body));
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::created(function ($answer){

            $answer->question->increment('answers_count');
        });

        static::deleted(function ($answer){
            
            $answer->question->decrement('answers_count');
        });

    }

    public function getStatusAttribute()
    {
        return $this->isBest() ? 'vote-acepted' : '';
    }

    public function getIsBestAttribute()
    {
        return $this->isBest();
    }

    public function isBest()
    {
        return $this->id == $this->question->best_answer_id;
    }

}
