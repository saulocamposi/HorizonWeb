<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['language'];

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_language');
    }
}
