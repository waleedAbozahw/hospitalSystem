<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diagnosis extends Model
{
    public function Doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }
}
