<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Post;
use App\Models\userProfile;
use App\Models\Aanvraag;

class UserProfileController extends Controller
{
    public function index(User $user) : View
    {
        $Puser = User::where('id', $user->id)->first();
        $Puser_img = userProfile::where('user_id', $user->id)->get();
        $pets = Post::where('user_id', $user->id)->get();
        return view('userProfile.index', [
            'user' => $Puser,
            'images' => $Puser_img,
            'posts' => Post::all(),
            'petInfo' => $pets,
        ]);
    }

    public function upload(User $user, Request $request)
    {
        $name = null;
        $video_name = null;

        $request->validate([
            'image_user' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_user' => 'mimes:mp4,mov,avi|max:102400'
        ]);

        if($request->hasFile('video_user')){
            $video = $request->file('video_user');
            $video_name = time().'.'.$video->extension();
            $video->storeAs('public/videos_users', $video_name);
        }
        
        if($request->hasFile('image_user')){
            $image = $request->file('image_user');
            $name = time().'.'.$image->extension();
            $image->storeAs('public/images_users', $name);
        }
        
        userProfile::create([
            'user_id' => $user->id,
            'image_user' => $name,
            'video_user' => $video_name,
        ]);
        
        return redirect(route('userProfile.index', $user));
    }
}
