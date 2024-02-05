<?php

namespace App\Models;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
class InformationEbook extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'small_title',
        'description',
        'tags_table',
        'date',
        'price',
    ];


    public function setEncryptedLinkAttribute($value)
    {
        $this->attributes['encrypted_link'] = Crypt::encryptString($value);
    }

    public function getDecryptedLinkAttribute()
    {
        return Crypt::decryptString($this->attributes['encrypted_link']);
    }
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
