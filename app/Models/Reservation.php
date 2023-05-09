<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $fillable = ['user_id', 'book_id', 'checked_out_at', 'checked_in_at'];

    public function book() : BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
    // public function user() : BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }
}
