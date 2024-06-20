<?php

namespace App\Http\Controllers;

//import Model "post"
use App\Models\Post;
//return type View
use Illuminate\View\View;
//return type redirect response
use Illuminate\Http\RedirectResponse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * index
     * 
     * @return View
     * 
     */
    public function index(): View
    {
        //gets post
        $posts = Post::latest()->paginate(5);

        //render view with post
        return view('posts.index', compact('posts'));
    }
    public function create(): View
    {
        return view('posts.create');
    }
    public function store(Request $request): RedirectResponse
    { 
        //validate form 
        $this->validate($request, [ 
        'image' => 'required|image|mimes:jpeg,jpg,png|max:2048', 
        'title' => 'required|min:5', 
        'content' => 'required|min:10' 
        ]); 
         
        //upload image 
        $image = $request->file('image'); 
        $image->storeAs('public/posts', $image->hashName()); 
         
        //create post 
        Post::create([ 
        'image' => $image->hashName(), 
        'title' => $request->title, 
        'content' => $request->content 
        ]);
         //redirect to index
         return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Tersimpan!']);
    }
    public function show(string $id)
    {
        //get post by id
        $post = Post::findOrFail($id);

        //render view with post
        return view('posts.show',compact('post'));
    }
    public function destroy($id):RedirectResponse
    {
        //get id
        $post = Post::findOrFail($id);

        //delete img
        Storage::delete('public/posts/'.$post->image);

        //delete post
        $post->delete();

        //retun to index
        return redirect()->route('posts.index')->with(['success'=>'data berhasil dihapus!']);
    }
    public function edit(string $id):View
    {
         //get id
         $post = Post::findOrFail($id);
        
         //render view with post
         return view('posts.edit',compact('post'));
    }
    public function update(Request $request, $id): RedirectResponse 
        { 
            //validate form 
            $this->validate($request, [ 
            'image' => 'image|mimes:jpeg,jpg,png|max:2048', 
            'title'=> 'required|min:5', 
            'content' => 'required|min:10' 
            ]);           
            //get post by ID 
            $post = Post::findOrFail($id); 
            //check if image is uploaded 
            if ($request->hasFile('image')) { 
            //upload new image 
            $image = $request->file('image'); 
            $image->storeAs('public/posts', $image->hashName()); 
            //delete old image 
            Storage::delete('public/posts/'.$post->image); 
           
            //update post with new image 
            $post->update([ 
            'image' 
            => $image->hashName(), 
            'title' => $request->title, 
            'content' => $request->content 
            ]); 
            } else {         
            //update post without image 
            $post->update([ 
            'title' => $request->title, 
            'content' => $request->content 
            ]); 
            
            }      
            //redirect to index 
            return redirect()->route('posts.index')->with(['success' => 'Data 
            Berhasil Diubah!']); 
        } 
}
