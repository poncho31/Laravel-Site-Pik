<?php

namespace App\Http\Controllers;

use App\article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class InprogressController extends Controller
{
    public function index()
    {
        $articles = DB::table('articles')->orderBy('updated_at', 'DESC')->paginate(12);
        $links = $articles->links();
        return view('inprogress', compact('articles', 'links'));
    }

    public function create()
    {
        return view('inprogress.create');
    }

    public function store(Request $request, article $article)
    {
        if(isset($request->image)){
            $path = Storage::disk('images')->put("article",  $request->image[0]);
        }
        else{
            $path = null;
        }
        $article = new article();
        $article->name = $request->post('title');
        $article->content = $request->post('article');
        $article->image = $path;
        $article->imagePosition = $request->post('imagePosition');
        $article->user_id = auth()->id();
        $article->save();

        return $this->index();
    }

    public function delete()
    {
        return view('inprogress');
    }

}
