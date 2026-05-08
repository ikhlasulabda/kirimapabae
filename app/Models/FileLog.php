<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileLog extends Model
{
    protected $fillable = [
        'file_id',
        'action',
        'ip_address',
    ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}