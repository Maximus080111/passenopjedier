<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(): View {
        if(!auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $users = User::all();
        $posts = Post::all();
        $currentUserId = Auth::id();

        $users = $users->map(function ($user) use ($currentUserId) {
            $user->can_manage = $user->id !== $currentUserId;
            return $user;
        });

        return view('admin.index', compact('users', 'posts'));
    }

    public function block(User $user) {
        $user->is_blocked = $user->is_blocked ? 0 : 1;
        $user->save();
        return redirect(route('admin.index'));
    }

    public function admin(User $user) {
        $user->is_admin = $user->is_admin ? 0 : 1;
        $user->save();
        return redirect(route('admin.index'));
    }
}
