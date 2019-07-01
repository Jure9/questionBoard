<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Parsedown;

class Question extends Model
{

    use VotableTrait;

    protected $fillable= ['title', 'body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class)->orderBy('votes_count', 'DESC');
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title']= $value;

        $this->attributes['slug']= Str::slug($value, '-');
    }

    public function getUrlAttribute()
    {
        return route("questions.show", $this->slug);
    }

    public function getStatusAttribute()
    {
        if ($this->answers_count > 0)
        {

            if ($this->best_answer_id)
            {
                return "answer-accepted";
            }
            return "answered";
        }

        return "unanswered";
    }

    public function getBodyHtmlAttribute()
    {
        return clean($this->bodyHtml());
    }

    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answer_id= $answer->id;

        $this->save();
    }

    public function favourites()
    {
        return $this->belongsToMany(User::class, 'favourites')->withTimestamps();
    }

    public function isFavourited()
    {
        return $this->favourites()->where('user_id', auth()->id())->count() > 0;

    }

    public function getIsFavouritedAttribute()
    {
        return $this->isFavourited();
    }

    public function getFavouritesCountAttribute()
    {
        return $this->favourites()->count();
    }

    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->bodyHtml()), 300);
    }

    private function bodyHtml()
    {
        return Parsedown::instance()->text($this->body);
    }
}
