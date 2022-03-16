<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     public function addPost()
     {
         return view('add-post');
     }
     public function createPost(Request $request)
     {
         $post = new Post();
         $post->title = $request->title;
         $post->body = $request->body;
         $post->save();
         return redirect('posts')->with('post_created','Post has been created');
     }
     public function getPost(){
         $posts = Post::orderby('id','DESC')->get();
         return View('posts',compact('posts'));
     }
     public function getPostById($id){
         $post = Post::where('id',$id)->first();
         return View('single-post',compact('post'));
     }
    
    public function deletePost($id)
    {
        Post::where('id',$id)->delete();
        return redirect('posts')->with('post_deleted','Post has been deleted'); 
    }
    public function editPost($id)
    {
        $post = Post::find($id);
        return view('edit-post',compact('post'));
    }
    public function updatePost(Request $request)
    {
    $post = Post::find($request->id);
    $post->title = $request->title;
    $post->body = $request->body;
    $post->save();
    return redirect('posts')->with('post_updated','Post has been updated');
    }
  
}
