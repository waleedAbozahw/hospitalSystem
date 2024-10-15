<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporatory extends Model
{
    use HasFactory;
    public $guarded = [];

    public function Doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }
    public function Patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }
    public function employee()
    {
        return $this->belongsTo(LaporatoryEmployee::class,'employee_id');
    }
    public function images(){
        return $this->morphMany(Image::class,'imageable');
     }
}
