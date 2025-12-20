<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 2 Admins
        User::create([
            'name' => 'Admin 1',
            'email' => 'admin1@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'classe_id' => null,
        ]);

        User::create([
            'name' => 'Admin 2',
            'email' => 'admin2@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'classe_id' => null,
        ]);

        // 4 Professeurs
        $professeurs = [
            ['name' => 'Professeur Alpha', 'email' => 'alpha.prof@example.com'],
            ['name' => 'Professeur Bravo', 'email' => 'bravo.prof@example.com'],
            ['name' => 'Professeur Charlie', 'email' => 'charlie.prof@example.com'],
            ['name' => 'Professeur Delta', 'email' => 'delta.prof@example.com'],
        ];

        foreach ($professeurs as $prof) {
            User::create([
                'name' => $prof['name'],
                'email' => $prof['email'],
                'password' => Hash::make('password'),
                'role' => 'professeur',
                'classe_id' => null,
            ]);
        }

        // 9 Élèves
        for ($i = 1; $i <= 9; $i++) {
            User::create([
                'name' => "Élève $i",
                'email' => "eleve$i@example.com",
                'password' => Hash::make('password'),
                'role' => 'eleve',
                'classe_id' => null, // tu peux mettre une classe quand elle existe
            ]);
        }
    }
}
