<?php

namespace Database\Seeders;

use App\Models\SendMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SendMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SendMessage::factory()->count(50)->create();
    }
}
