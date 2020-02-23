<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'surname', 'email', 'gender'
    ];

    protected $dates = [
        'joined_date',
    ];


    public function scopeFilter($query)
    {
        if (request('firstname')) {
            $query->where('firstname', request('firstname'));
        }

        if (request('surname')) {
            $query->where('surname', request('surname'));
        }

        if (request('email')) {
            $query->where('email', request('email'));
        }

        if (request('gender')) {
            $query->where('gender', request('gender'));
        }

        return $query;
    }
}
