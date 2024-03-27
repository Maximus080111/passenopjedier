<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aanvraag;
use App\Models\Post;

class AanvraagController extends Controller
{
    public function store(Post $post)
    {
        Aanvraag::create([
            'user_id' => Auth()->user()->id,
            'post_id' => $post->id,
        ]);
 
        return redirect(route('posts.index'));
    }

    public function edit(Aanvraag $aanvraag)
    {
        $aanvraag->accepted = 1;
        $aanvraag->save();
        return redirect(route('dashboard'));
    }

    public function destroy(Aanvraag $aanvraag)
    {
        $aanvraag->delete();
        return redirect(route('dashboard'));
    }
}
