<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'is_employer',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Events when the new user is created
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->profile()->create([
                'user_id' => $user->id,
            ]);
        });
    }

    //Get all User Jobs
    public function jobs()
    {
        return $this->hasMany(Job::class, 'created_by');
    }

    //Connection between User and his profile
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    //get all jobs which user applied on
    public function applied()
    {
        return $this->hasMany(Application::class);
    }

    //Get feedbacks to user applications
    public function notifications()
    {
        return $this->hasMany(Application::class)->where('viewed', false);
    }


    public function allEmployerApplication()
    {
        //return $this->hasMany(Application::class);

        return $this->hasManyThrough(
            Application::class,
            Job::class,
            'user_id', // Foreign key on the Job table...
            'id', // Foreign key on the application table...
            'job_id', // Local key on the users table...
            'id' // Local key on the application table...
        );
    }
}
