<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoggedDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'platform',
        'browser',
        'user_agent',
        'ip_address',
        'last_activity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}