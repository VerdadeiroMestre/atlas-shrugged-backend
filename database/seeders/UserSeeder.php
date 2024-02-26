<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $characters = Storage::disk('json')->json('characters.json');

        foreach($characters['characters'] as $character){
            $user = new User;
            $user->name = $character['full_name'];
            $user->email = $character['email'];
            $user->password = $character['password'];
            $user->save();
        }
    }
}
