<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('appointments')->delete();
        $Appointments = [
            ['name' => 'السبت'],
            ['name' => 'الاحد'],
            ['name' => 'الاثنين'],
            ['name' => 'الثلاثاء'],
            ['name' => 'الاربعاء'],
            ['name' => 'الخميس'],
            ['name' => 'الجمعة'],
        ];
        foreach($Appointments as $Appointment){
            Appointment::create($Appointment);
        }

        // $All_Appointments = Appointment::all();
        // Doctor::all()->each(function($doctor) use ($All_Appointments){
        //     $doctor->doctorappointments()->attach(
        //         $All_Appointments->random(rand(1,7))->pluck('id')->toArray()
        //     );
        // });

        $doctors=Doctor::all();
        foreach ($doctors as $doctor) {
            $All_Appointments = Appointment::all()->random()->id;
          $doctor->doctorappointments()->attach($Appointments);
        }

    }
}
