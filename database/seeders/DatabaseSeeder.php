<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
            'name' => 'Kishan Patel',
            'email' => 'kishanmnpatel@gmail.com',
            'password' => Hash::make('password'),
        ]);

        \App\Models\Surname::factory()->create([
            'english_word' => 'Chhabhaiya',
            'gujarati_word' => 'છાભૈયા',
        ]);
        \App\Models\Surname::factory()->create([
            'english_word' => 'Pokar',
            'gujarati_word' => 'પોકાર',
        ]);
        \App\Models\Surname::factory()->create([
            'english_word' => 'Nakrani',
            'gujarati_word' => 'નાકરાણી',
        ]);
        \App\Models\Surname::factory()->create([
            'english_word' => 'Divani',
            'gujarati_word' => 'દીવાણી',
        ]);
        \App\Models\Surname::factory()->create([
            'english_word' => 'Dholu',
            'gujarati_word' => 'ધોળું',
        ]);
        \App\Models\Surname::factory()->create([
            'english_word' => 'Ghoghari',
            'gujarati_word' => 'ઘોઘારી',
        ]);
        \App\Models\Surname::factory()->create([
            'english_word' => 'Rudani',
            'gujarati_word' => 'રૂડાણી',
        ]);
    }
}
