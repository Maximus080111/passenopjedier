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

    public function edit(Aanvraag $aanvraag, Post $post){
        $aanvraag->accepted = 1;
        $aanvraag->save();      

        // $aanvragen = Aanvraag::where('post_id' == $aanvraag->post_id);  

        $post->is_review = 1;
        $post->save();

        return redirect('dashboard');
    }

    public function destroy(Aanvraag $aanvraag)
    {
        $aanvraag->delete();
        return redirect(route('dashboard'));
    }
}
