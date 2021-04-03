<?php
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(BloodTableSeeder::class);
        $this->call(NationalitiesTableSeeder::class);
        $this->call(ReligionTableSeeder::class);
        $this->call(SpecializationsTableSeeder::class);
        $this->call(GenderTableSeeder::class);
    }
}
