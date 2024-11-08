<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Post;
use App\Models\userProfile;
use App\Models\Aanvraag;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index(User $user) : View
    {
        $currentuser = Auth::user();
        $isCurrentUser = $currentuser && $currentuser->id == $user->id;
        $images = userProfile::where('user_id', $user->id)->get();
        $hasImages = $images->whereNotNull('image_user')->isNotEmpty();
        $hasVideos = $images->whereNotNull('video_user')->isNotEmpty();
        $pets = Post::where('user_id', $user->id)->get();
        return view('userProfile.index', [
            'user' => $user,
            'images' => $images,
            'isCurrentUser' => $isCurrentUser,
            'hasImages' => $hasImages,
            'hasVideos' => $hasVideos,
            'petInfo' => $pets,
        ]);
    }

    public function upload(User $user, Request $request)
    {
        $validated = $request->validate([
            'image_user' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'video_user' => 'mimes:mp4,mov,avi|max:102400|nullable'
        ]);
    
        $image_name = $request->hasFile('image_user') ? time().'.'.$request->file('image_user')->extension() : null;
        $video_name = $request->hasFile('video_user') ? time().'.'.$request->file('video_user')->extension() : null;
    
        if ($image_name) {
            $request->file('image_user')->storeAs('public/images_users', $image_name);
        }
    
        if ($video_name) {
            $request->file('video_user')->storeAs('public/videos_users', $video_name);
        }
    
        userProfile::create([
            'user_id' => $user->id,
            'image_user' => $image_name,
            'video_user' => $video_name,
        ]);
    
        return redirect(route('userProfile.index', $user));
    }
}
