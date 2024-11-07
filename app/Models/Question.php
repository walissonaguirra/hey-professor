<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'draft' => 'bool',
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
