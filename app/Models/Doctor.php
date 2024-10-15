<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Authenticatable
{
    use HasFactory;
    use Translatable;
    protected $fillable = ['email','email_verified_at','work_days','number_of_statements','password','phone','name','section_id','status'];
   // protected $guarded = [];
    public $translatedAttributes = ['name','appointments'];

    // get the doctor image
    public function image(){
       return $this->morphOne(Image::class,'imageable');
    }

    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }

    public function doctorappointments(){
        return $this->belongsToMany(Appointment::class,'pivot_appointment_doctor');
    }
}
