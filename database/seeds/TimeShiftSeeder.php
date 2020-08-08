<?php

use App\TimeShift;
use Illuminate\Database\Seeder;

class TimeShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TimeShift::firstOrCreate([
            'title' => 'Morning'
        ]);

        TimeShift::firstOrCreate([
            'title' => 'Afternoon'
        ]);

        TimeShift::firstOrCreate([
            'title' => 'Night'
        ]);
    }
}
