<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            "password" => Hash::make("admin"),
        ]);
        \App\Models\ChatRoom::factory()->create([
            'title' => 'test'
        ]);
        \App\Models\Guest::factory()->create([]);
        \App\Models\Chat::factory()->create([]);
    }
}
