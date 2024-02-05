<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function profile(User $user)
    {
        return view('profile-posts', ['username'=>$user->username,'posts'=>$user->posts()->latest()->get(),'postCount'=>$user->posts()->count()]);
    }
    public function showEditForm(Post $post){
        return view('edit-post',['post'=>$post]);    
    }
    public function updatePost(Post $post, Request $request){
        $incommingFields=$request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);
        $incommingFields['title']=strip_tags($incommingFields['title']);
        $incommingFields['body']=strip_tags($incommingFields['body']);
        $post->update($incommingFields);
        return back()->with('success','post updated successfully.');

    }
   
    public function deletePost(Post $post){
       
        $post->delete();
        return redirect('/profile/'.auth()->user()->username)->with('success','Post deleted successfuly');
    }
    public function viewSinglePost(User $user, Post $post){

        return view('single-post',['user'=>$user,'post'=>$post]);
    }
    public function showCreatePostForm(){
        return view('create-post');
    }
    public function storePost(Post $post, Request $request){
        $incommingFields=$request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);
        $incommingFields['title']=strip_tags($incommingFields['title']);
        $incommingFields['body']=strip_tags($incommingFields['body']);
        $incommingFields['user_id']=auth()->id();
        $newPost=$post->create($incommingFields);
        return redirect("/post/{$newPost->id}")->with('success','New post successfully created');
    }
}
