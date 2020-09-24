<?php

namespace OZiTAG\Tager\Backend\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class UserResetToken extends Model
{
    protected $table = 'tager_users_reset_tokens';

    protected $fillable = [
        'user_id', 'token', 'status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
