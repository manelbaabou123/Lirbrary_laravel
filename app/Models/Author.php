<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';

    protected $fillable = ['name'];

    protected $dates = ['dob'];
    // public function setDobAttribute($dob)
    // {
    //     $this->attributes['dob'] = Carbon::parse($dob);
    // }
    // public function book(): HasMany
    // {
    //     return $this->hasMany(Book::class);
    // }
}
