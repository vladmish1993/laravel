<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;

    public function profileskills()
    {
        return $this->hasMany(ProfileSkills::class);
    }

    public function jobskills()
    {
        return $this->hasMany(JobSkills::class);
    }
}
