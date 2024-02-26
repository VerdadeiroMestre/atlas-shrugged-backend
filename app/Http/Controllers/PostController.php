<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Criar um novo post
     * @api POST /post
     * 
     * @param \Illuminate\Http\Request $request contendo os seguintes dados necessários para a criação do post:
     * @param string $text texto do post a ser criado
     * @param int $user_id id do usuário de autoria do post
     * 
     * @return \Illuminate\Http\Response retorna um JSON com uma mensagem de sucesso
     */
    public function createPost(Request $request){
        $post = new Post;
        $post->text = $request->text;
        $post->user_id = $request->user_id;
        $post->save();

        return response()->json([
            "message" => "Post created"
        ],201);
    }

    /**
     * Atualiza|Edita um post do usuário
     * @api POST /update-post
     * 
     * @param \Illuminate\Http\Request $request contendo os seguintes dados necessários para a criação do post:
     * @param int $post_id id do post a ser editado
     * @param string $text novo texto do post
     * 
     * @return \Illuminate\Http\Response retorna um JSON com uma mensagem de sucesso
     */
    public function updatePost(Request $request){
        $post = Post::find($request->post_id);
        $post->text = $request->text;
        $post->save();

        return response()->json([
            "message" => "Post updated"
        ],201);
    }

    /**
     * Deleta um post do usuário
     * @api DELETE /post/{id}
     * 
     * @param int $id id do post a ser deletado
     * 
     * @return \Illuminate\Http\Response retorna um JSON com uma mensagem de sucesso
     */
    public function deletePost($id){
        if(Post::where('id',$id)->exists()){
            $post = Post::find($id);
            $post->delete();

            return response()->json([
                "message" => "Post deletd"
            ],201);
        }else{
            return response()->json([
                "message" => "Post not found"
            ],404);
        }
    }


    /**
     * Retorna todos os posts
     * @api GET /posts
     * 
     * @return \Illuminate\Http\Response retorna um JSON contendo os posts
     */
    public function getAllPosts(){
        $posts = Post::orderByDesc('created_at')
                    ->get()->toJson(JSON_PRETTY_PRINT);
        return response($posts,200);
    }

    /**
     * Retorna o autor de um post
     * @api GET /get-author/{id}
     * 
     * @param int $id id do post
     * 
     * 
     * @return \Illuminate\Http\Response retorna um JSON com nome do usuário autor do post
     */
    public function getAuthor($id){
        $post = Post::where('id',$id)->first();
        $user = User::where('id',$post->user_id)->first();
        return response()->json([
            "name" => $user->name
        ],200);
    }
}
