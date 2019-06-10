<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ImageRepository;
use App\category;

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
    public function index(Request $request, $imagesSection, $imagesProject) 
    {
        $postCategory = $request->post('category');
        $category = isset($postCategory)?$postCategory:null;

        $images = $this->imageRepo->getPaginate(8, $imagesSection, $imagesProject, $category);
        if($request->ajax()){
            // dd($request);
            return ['images'=>view('images.ajaxLoad')->with(compact('images', 'imagesSection', 'imagesProject'))->render(),
            "next-page"=>$images->nextPageUrl()
            ];
        }
        return view('images.view', compact('images', 'imagesSection', 'imagesProject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = category::all();
        return view('images.create', compact('categories'));
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
