<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ResetPassword extends Model
{
    use HasFactory;

    protected $table = 'reset_password';

    protected $fillable = [
        'token',
    ];

    /**
     * @return bool
     */
    public function tokenExpired(): bool
    {
        if(Carbon::parse($this->created_at)->diffInHours(Carbon::now()) > 2) {
            return true;
        }

        return false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
