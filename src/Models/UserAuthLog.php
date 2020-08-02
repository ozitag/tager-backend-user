<?php

namespace OZiTAG\Tager\Backend\User\Models;

use Illuminate\Database\Eloquent\Model;

class UserAuthLog extends Model
{
    const UPDATED_AT = null;

    protected $table = 'tager_administrator_auth_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip',
        'administrator_id'
    ];
}
