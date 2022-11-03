<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileSkills extends Model
{
    use HasFactory;

    protected $fillable = ['profile_id', 'skills_id'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function skills()
    {
        return $this->belongsTo(Skills::class);
    }
}