<?php

namespace App\Http\Controllers;

use App\article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class InprogressController extends Controller
{
    protected $article;
    public function __construct(article $article)
    {
        $this->article = $article;
    }
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

    /**
     * Delete the specified article.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->article->findOrFail($id)->delete();
            return response()->json(['code'=> 200,'message' => 'Record has been deleted successfully!']);
        } catch (\PDOException $e) {
            return response()->json(['code'=> 500,'message' => 'Error : ' . $e->message]);
        }
    }

}
