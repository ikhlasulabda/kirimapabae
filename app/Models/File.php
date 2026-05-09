<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'original_name',
        'stored_name',
        'token',
        'password',
        'expires_at',
        'description',
        'download_count',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function logs()
    {
        return $this->hasMany(FileLog::class);
    }
}