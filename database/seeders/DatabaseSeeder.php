<?php

namespace Database\Seeders;

use App\Models\MembershipType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        MembershipType::truncate();

        MembershipType::create([
            "name" => 'Adult (Standard)',
            "description" => 'Standard membership for adults',
            "year_price" => 160
        ]);

        MembershipType::create([
            "name" => 'Junior (Standard)',
            "description" => 'Standard membership for juniors',
            "year_price" => 100
        ]);

        MembershipType::create([
            "name" => 'Student (Standard)',
            "description" => 'Standard membership for student',
            "year_price" => 110
        ]);
    }
}
