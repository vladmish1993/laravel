<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = ['user_id', 'phone', 'cover_letter', 'cv', 'company_name', 'show_phone'];

    //Connection between User and his profile
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //User profile skills
    public function skills()
    {
        return $this->hasMany(ProfileSkills::class);
    }

    //For db seeder
    public function profileSkill()
    {
        return $this->hasMany(ProfileSkills::class);
    }
}