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
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : View
    {
        $speciesFilter = $request->query('species');
        $priceFilter = $request->query('price_max');
        $startDateFilter = $request->query('start_date');
        $endDateFilter = $request->query('end_date');

        $posts = Post::with('user')->latest()
        ->when($speciesFilter, fn($query) => $query->where('species', $speciesFilter))
        ->when($priceFilter, fn($query) => $query->where('price', '<=', $priceFilter))
        ->when($startDateFilter, fn($query) => $query->where('start_date', '>=', $startDateFilter))
        ->when($endDateFilter, fn($query) => $query->where('end_date', '<=', $endDateFilter))
        ->get();

        return view('posts.index', [
            'posts' => $posts,
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
        $validated = $request->validate([
            'pet_name' => 'required|string|max:255',
            'message' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'price' => 'required|numeric|min:0',
            'species' => 'required|string|max:20',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'mimes:mp4,mov,avi|max:102400',
        ]);
    
        $name = $request->hasFile('image') ? time().'.'.$request->file('image')->extension() : null;
        $video_name = $request->hasFile('video') ? time().'.'.$request->file('video')->extension() : null;
    
        if ($name) {
            $request->file('image')->storeAs('public/images', $name);
        }
    
        if ($video_name) {
            $request->file('video')->storeAs('public/videos', $video_name);
        }
    
        Post::create(array_merge($validated, [
            'user_id' => Auth()->user()->id,
            'image' => $name,
            'video' => $video_name,
        ]));
    
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

        $species = DB::table('species')->get();
 
        return view('posts.edit', [
            'post' => $post,
            'species' => $species,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        $this->authorize('update', $post);
      
        $updateData = [
            'pet_name' => $request->input('pet_name'),
            'message' => $request->input('message'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'price' => $request->input('price'),
            'species' => $request->input('species'),
            'user_id' => Auth()->user()->id,
        ];

        if($request->hasFile('video')){
            Storage::delete('public/videos/'.$post->video);
            $video = $request->file('video');
            $video_name = time().'.'.$video->extension();
            $video->storeAs('public/videos', $video_name);
            $updateData['video'] = $video_name;
        }

        if($request->hasFile('image')){
            Storage::delete('public/images/'.$post->image);
            $image = $request->file('image');
            $name = time().'.'.$image->extension();
            $validated['image'] = $name;
            $image->storeAs('public/images', $name);
            $updateData['image'] = $name;
        }
        
        
        $post->update($updateData);
        
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);

        foreach (['video', 'image'] as $fileType) {
            if ($post->$fileType) {
                Storage::disk('public')->delete($fileType . 's/' . $post->$fileType);
            }
        }
    
        $post->delete();
    
        return redirect(auth()->user()->is_admin ? route('admin.index') : route('posts.index'));
    }
}
