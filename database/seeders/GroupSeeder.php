<?php

namespace Database\Seeders;

use App\Models\Group;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $started_at = Verta::today()->datetime();
        $ended_at = \verta('+1 month')->datetime();

        Group::create([
            'title' => "دانشجویان دانشگاه یاسوج",
            'course_id' => 1,
            'started_at' => $started_at,
            'ended_at' => $ended_at,
        ]);
    }
}
