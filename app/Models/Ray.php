<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ray extends Model
{
   public $guarded = [];

   public function Doctor()
   {
       return $this->belongsTo(Doctor::class,'doctor_id');
   }
   public function Patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function RayEmployee(){
        return $this->belongsTo(RayEmployee::class,'employee_id')->withDefault(['name'=>'No Employee']);
    }

    public function images(){
        return $this->morphMany(Image::class,'imageable');
     }
}
