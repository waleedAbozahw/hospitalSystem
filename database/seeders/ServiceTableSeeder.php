<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $singleService = new Service();
       $singleService->price=500;
       $singleService->status=1;
       $singleService->description='تركيب اسنان';
       $singleService->save();
       // store trans
       $singleService->name='كشف';
       $singleService->save();
    }
}
