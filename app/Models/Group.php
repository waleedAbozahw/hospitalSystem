<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['name','notes'];
    protected $guarded = [];

   public function service_group(){
      return $this->belongsToMany(Service::class,'pivot_service_group')->withPivot('quantity');
   }
}
