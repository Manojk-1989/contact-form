<?php

namespace ContactForm\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'email', 'subject', 'message',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
