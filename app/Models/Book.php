<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = ['title', 'author_id'];

    public function path()
    {
        return '/books/show/'.$this->id;
    }

    public function checkout($user)
    {
        $this->reservations()->create([
            'user_id' => $user->id,
            'checked_out_at' => now(),
        ]);
    }

    public function checkin($user)
    {
        $reservation = $this->reservations()->where('user_id', $user->id)
            ->whereNotNull('checked_out_at')
            ->whereNull('checked_in_at')
            ->first();
        // dd($reservation);
        if (is_null($reservation)) {
            throw new \Exception();
        }
        $reservation->update([
            'checked_in_at' => now(),
        ]);
    }

    public function setAuthorIdAttribute($author)
    {
        $this->attributes['author_id'] = (Author::firstOrCreate([
            'name' => $author,
        ]))->id;
    }

    // public function author() : BelongsTo
    // {
    //     return $this->belongsTo(Author::class, 'author_id');
    // }
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
