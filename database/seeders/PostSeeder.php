<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Storage::disk('json')->json('posts.json');

        foreach($posts['posts'] as $post){
            $user = User::where('email', $post['email'])->first();
            
            $new_post = new Post;
            $new_post->text = $post['text'];
            $new_post->user_id = $user->id;
            $new_post->save();
        }
    }
}
