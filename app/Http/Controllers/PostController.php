<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Species;
use Illuminate\Http\Response;
use Illuminate\View\View; 
use Illuminate\Http\Request;
use App\Models\Aanvraag;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $species = DB::table('species')->get();
        return view('posts.index', [
            'posts' => Post::with('user')->latest()->get(),
            'species'=> Species::all(),
            'aanvragen' => Aanvraag::where('user_id', Auth()->user()->id)->get(),
        ]);
    }

    public function create() : View
    {
        return view('posts.create', [
            'species' => Species::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = null;
        $video_name = null;

        $validated = $request->validate([
            'dog_name' => 'required|string|max:255',
            'message' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'price' => 'required|numeric|min:0',
            'species' => 'required|string|max:20',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'mimes:mp4,mov,avi|max:102400',
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->extension();
            $image->storeAs('public/images', $name);
        }
        if($request->hasFile('video')){
            $video = $request->file('video');
            $video_name = time().'.'.$video->extension();
            $video->storeAs('public/videos', $video_name);
        }

        Post::create([
            'dog_name' => $request->input('dog_name'),
            'message' => $request->input('message'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'price' => $request->input('price'),
            'species' => $request->input('species'),
            'user_id' => Auth()->user()->id,
            'image' => $name,
            'video' => $video_name,
        ]);
 
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        $this->authorize('update', $post);
 
        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        $this->authorize('update', $post);
 
        $validated = $request->validate([
            'dog_name' => 'required|string|max:255',
            'message' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'price' => 'required|numeric|min:0',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'mimes:mp4,mov,avi|max:102400',
        ]);

        if($request->hasFile('video')){
            Storage::delete('public/videos/'.$post->video);
            $video = $request->file('video');
            $video_name = time().'.'.$video->extension();
            $video->storeAs('public/videos', $video_name);
        }

        if($request->hasFile('image')){
            Storage::delete('public/images/'.$post->image);
            $image = $request->file('image');
            $name = time().'.'.$image->extension();
            $validated['image'] = $name;
            $image->storeAs('public/images', $name);
        }
 
        $post->update($validated);
 
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);

        if($post->video){
            Storage::delete('public/videos/'.$post->video);
        }

        if($post->image){
            Storage::delete('public/images/'.$post->image);
        }
 
        $post->delete();
        
        if(auth()->user()->is_admin){
            return redirect(route('admin.index'));
        } else {
            return redirect(route('posts.index'));
        }
    }
}
