<?php

namespace Database\Seeders;

use App\Models\RayEmployee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RayEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ray_employee = new RayEmployee();
        $ray_employee->name = 'محمد حسن';
        $ray_employee->email = 'm@gmail.com';
        $ray_employee->password = Hash::make('12345678');
        $ray_employee->save();
    }
}
