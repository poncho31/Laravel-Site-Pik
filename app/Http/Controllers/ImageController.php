<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\ImageRepository;
use Intervention\Image\Image;

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
        // dd($images);
        if($request->ajax()){
            return ['images'=>view('images.ajaxLoad')->with(compact('images', 'imageSection', 'imageProject'))->render(),
            "next-page"=>$images->nextPageUrl()
            ];
        }
        // dd($images);
        return view('images.view', compact('images', 'imageSection', 'imageProject', 'categories'));
    }

    private function getAllCategories(){
        return [
            'sections' => DB::table('sections')->select('id','name')->groupBy('name')->get(),
            'projects' => DB::table('projects')->select('id','name')->groupBy('name')->get(),
            'categories' => DB::table('categories')->select('id','name')->groupBy('name')->get()
        ];
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $request = new Request();
        // dd(phpinfo());
        // dd($request);
        $group = $this->getAllCategories();
        return view('images.create', ['sections'=>$group['sections'], 'projects'=>$group['projects'], 'categories'=>$group['categories']]);
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
            'image.*' => '|mimes:jpg,png,jpeg',
            'description' => 'nullable|string|max:1000',
            ]);
        // dd($request);
        $this->imageRepo->store($request);
        return $this->create();
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
     * delete the specified resource image in Database
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->imageRepo->delete($id);
            return response()->json(['code'=> 200,'message' => 'Record has been deleted successfully!']);
        } catch (\PDOException $e) {
            return response()->json(['code'=> 500,'message' => 'Error : ' . $e->message]);
        }
    }


    public function globalDeleteView(){
        $group = $this->getAllCategories();
        return view('globalDelete', ['sections'=>$group['sections'], 'projects'=>$group['projects'], 'categories'=>$group['categories']]);
    }
    public function globalDelete(Request $request){
        try {
            $section = $request->post('section');
            $project = $request->post('project');
            $category = $request->post('category');
            $all = $request->post('all');
            // dd($request);
            if ($section != null) {
                $this->imageRepo->deleteSection($section);
            }
            if ($project != null) {
                $this->imageRepo->deleteProject($project);
            }
            if ($category != null) {
                $this->imageRepo->deleteCategory($category);
            }
            if ($all != null) {
                $this->imageRepo->deleteAll();
            }
        } catch (\PDOException $e) {
            return response()->json(['code'=> 500,'message' => 'Error : ' . $e]);
        }

        return $this->globalDeleteView();
    }
}
