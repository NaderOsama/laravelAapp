<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drive extends Model
{
    protected $table = 'drives';

    protected $fillable = ['title', 'description', 'file', 'status', 'user_id'];

    // Relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
