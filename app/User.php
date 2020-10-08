<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string)Str::uuid();
        });
    }


    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function channel()
    {
        return $this->hasOne(Channel::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
    
    public function toggleVote($entity, $type)
    {
        $vote = $entity->votes->where('user_id', $this->id)->first();

        if ($vote) {
            $vote->update([
                'type' => $type
            ]);
            return $vote->refresh();
        } else {
            $vote = $entity->votes()->create([
                'user_id' => $this->id,
                'type' => $type,
            ]);

            return $vote;
        }
    }
}
