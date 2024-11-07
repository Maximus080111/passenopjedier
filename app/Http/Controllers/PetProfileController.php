<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Pet;
use App\Models\Post;
use App\Models\User;

class PetProfileController extends Controller
{
    public function index(Post $post) : View
    {
        $user = User::where('id', $post->user_id)->first();
        return view('petProfile.index', [
            'post' => $post,
            'user' => $user,
        ]);
    }
}
