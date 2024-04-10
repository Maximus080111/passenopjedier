<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Pet;
use App\Models\Post;

class PetProfileController extends Controller
{
    public function index(Post $post) : View
    {
        
        // $petInfo = Post::where('id', $post->id)->first();
        return view('petProfile.index', [
            'post' => $post,
        ]);
    }
}
