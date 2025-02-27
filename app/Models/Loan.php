<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{User, Book};

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'book_id', 
        'loan_date', 
        'return_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }



}
