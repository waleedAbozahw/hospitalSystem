<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patient = new Patient();
        $patient->email = 'sh@gmail.com';
        $patient->password = Hash::make('12345678');
        $patient->birth_date = '1988-12-01';
        $patient->phone = '12345678910';
        $patient->gender = 1;
        $patient->blood_group = 'A+';
        $patient->save();
        //insert trans
        $patient->name = ' شادي علي';
        $patient->address = 'القاهرة';
        $patient->save();
    }
}
