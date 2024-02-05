<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\InformationEbook;
class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'bookoption', 'filter', 'image','searchkey'];


    public function bookInformation()
    {
        return $this->hasOne(InformationEbook::class);
    }

    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'user_saved_books', 'book_id', 'user_id')
            ->withTimestamps();
    }

    public function ownedByUsers()
    {
        return $this->belongsToMany(User::class, 'user_owned_books', 'book_id', 'user_id')
            ->withTimestamps();
    }
}
