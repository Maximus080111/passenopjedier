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
        $user = User::find($post->user_id);
        $post->formatted_price = number_format($post->price, 2, ',', '.');
        $post->formatted_start_date = \Carbon\Carbon::parse($post->start_date)->format('j F Y');
        $post->formatted_end_date = \Carbon\Carbon::parse($post->end_date)->format('j F Y');

        return view('petProfile.index', compact('post', 'user'));
    }
}
