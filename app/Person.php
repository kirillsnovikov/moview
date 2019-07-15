<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Person extends Model
{

    protected $table = 'persons';
    protected $guarded = ['professions'];

    const MALE = 1;
    const FEMALE = 0;

    public function setSlugAttribute()
    {
        $this->attributes['slug'] = mb_strtolower(Str::slug((($this->name_en) ? $this->name_en : $this->name) . '_' . $this->id, '_'));
    }

    public function professions()
    {
        return $this->BelongsToMany('App\Profession');
    }

    public function movies()
    {
        return $this->belongsToMany('App\Movie');
    }

    public function directors()
    {
        return $this->belongsToMany('App\Movie', 'director_movie', 'director_id', 'movie_id');
    }

    public function actors()
    {
        return $this->belongsToMany('App\Movie', 'actor_movie', 'actor_id', 'movie_id');
    }

    public function countryBirth()
    {
        return $this->belongsTo('App\Country');
    }

    public function countryDeath()
    {
        return $this->belongsTo('App\Country');
    }

    public function scopeLastPersons($query, $count)
    {
        return $query->orderBy('created_at', 'desc')->take($count)->get();
    }

    public function userCreated()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function userModified()
    {
        return $this->belongsTo('App\User', 'modified_by');
    }

}
