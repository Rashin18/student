<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'name',
        'email',
        'address',
        'mobile',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
