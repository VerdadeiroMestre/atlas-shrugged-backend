<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request){
        $post = new Post;
        $post->text = $request->text;
        $post->user_id = $request->user_id;
        $post->save();

        return response()->json(['status' => 'success']);
    }

    public function updatePost(Request $request){
        $post = Post::find($request->post_id);
        $post->text = $request->text;
        $post->save();
        
        return response()->json(['status' => 'success']);
    }

    public function deletePost(Request $request){
        $post = Post::find($request->post_id);
        $post->delete();
        
        return response()->json(['status' => 'success']);
    }

    public function listPosts(Request $request){
        if($request->my_posts){
            $posts = Post::where('user_id', $request->user_id)
                        ->orderByDesc('created_at')
                        ->take(10)
                        ->get();
            return $posts;
        }
        $posts = Post::orderByDesc('created_at')
                    ->take(10)
                    ->get();
        return $posts;
    }

    public function getUserNameById(Request $request){
        $post = Post::where('id',$request->post_id)->first();
        $user = User::where('id',$post->user_id)->first();
        if($user){
            return $user->name;
        }
    }
}
