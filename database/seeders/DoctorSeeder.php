<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctor = new Doctor();
        $doctor->email='tarek@gmail.com';
        $doctor->password=Hash::make('12345678');
        $doctor->phone='12345678911';
        $doctor->work_days='السبت-الثلاثاء';
        $doctor->status=1;
        $doctor->section_id=1;
        $doctor->number_of_statements=5;
        $doctor->save();
        //store trans
        $doctor->name = 'طارق سيد';
        $doctor->save();
        $doctor = new Doctor();
        $doctor->email='ahmed@gmail.com';
        $doctor->password=Hash::make('12345678');
        $doctor->phone='12345678917';
        $doctor->work_days='السبت-الثلاثاء';
        $doctor->status=1;
        $doctor->section_id=1;
        $doctor->number_of_statements=5;
        $doctor->save();
        //store trans
        $doctor->name = 'احمد علي';
        $doctor->save();
    }
}
