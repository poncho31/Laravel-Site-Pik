<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\ImageRepository;

class ImageController extends Controller
{
    protected $imageRepo;
    /**
     * Create a new ImageController instance.
     *
     * @param  \App\Repositories\ImageRepository $repository
     */
    public function __construct(ImageRepository $imageRepo)
    {
        $this->imageRepo = $imageRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $imageSection, $imageProject) 
    {
        
        $images = $this->imageRepo->getPaginate(8, $imageSection, $imageProject);
        $categories = $this->imageRepo->getCategoriesByProject($imageProject);
        if($request->ajax()){
            return ['images'=>view('images.ajaxLoad')->with(compact('images', 'imageSection', 'imageProject'))->render(),
            "next-page"=>$images->nextPageUrl()
            ];
        }
        // dd($images);
        return view('images.view', compact('images', 'imageSection', 'imageProject', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = DB::table('sections')->select('id','name')->groupBy('name')->get();
        $projects = DB::table('projects')->select('id','name')->groupBy('name')->get();
        $categories = DB::table('categories')->select('id','name')->groupBy('name')->get();
        return view('images.create', compact('categories', 'projects', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            
            'image' => 'required',
            'image.*' => 'mimes:jpg,png,jpeg',
            'description' => 'nullable|string|max:255',
            ]);
        // dd($request);
        $this->imageRepo->store($request);
        return back()->with('ok', __("L'image a bien été enregistrée"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ajax(Request $request){
        $type = $request->post('type');
        if ($type == 'seeImage') {
            return $this->imageRepo->getAll();
        }
        else{
            return "error";
        }
    }
}
