<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;

class Job extends Model
{
    use HasFactory, CreatedUpdatedBy;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    protected $fillable = [
        'title',
        'salary',
        'description'
    ];

    //All users which applied to this job
    public function candidates()
    {
        return $this->belongsToMany(User::class);
    }

    //Get job's creator
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    //Job Skills
    public function skills()
    {
        return $this->hasMany(JobSkills::class);
    }

    //For db seeder
    public function jobSkill()
    {
        return $this->hasMany(JobSkills::class);
    }
}
