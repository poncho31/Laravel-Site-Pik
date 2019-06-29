<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;
use Illuminate\Support\Facades\DB;
use App\Image;
use App\section;
use App\project;
use App\category;

class ImageRepository
{
    protected $image;
    protected $category;
    protected $section;
    protected $project;
    public function __construct(Image $image, section $section, project $project){
        $this->image = $image;
        $this->section = $section;
        $this->project = $project;
    }

    public function store($request)
    {
        // dd(phpinfo());
        $section = $this->ifElse($request->post('section'), $request->post('section_new'));
        $project = $this->ifElse($request->post('project'), $request->post('project_new'));
        $category = $this->ifElse($request->post('category'), $request->post('category_new'));

        
        if ($request->post('section_new') != null) {
            $this->section = new section;
            $this->section->name = $section;
            $this->section->save();
            $section = $this->section->id;
        }
        if ($request->post('project_new') != null) {
            $this->project = new project;
            $this->project->name = $project;
            $this->project->save();
            $project = $this->project->id;
        }
        if ($request->post('category_new') != null) {
            $this->category =  new category;
            $this->category->name = $category;
            $this->category->save();
            $category = $this->category->id;
        }


        $sectionName = DB::table('sections')->where('id', $section)->pluck('name')->first();
        $projectName = DB::table('projects')->where('id', $project)->pluck('name')->first();

        foreach ($request->file('image') as $imageFile) {
            // Save image
            $path = Storage::disk('images')->put("/$sectionName/$projectName", $imageFile);
            // Save thumb
            $image = InterventionImage::make($imageFile)->widen(500);
            Storage::disk('thumbs')->put($path, $image->encode());
            // Save in base
            $this->image = new Image();
            $this->image->description = $request->description;
            $this->image->category_id = $category;
            $this->image->project_id = intval($project);
            $this->image->section_id = intval($section);
            $this->image->name = $path;
            $this->image->user_id = auth()->id();
            $this->image->save();
        }
        
    }

    private function ifElse($if, $else){
        return $if == null ? ($else == null ? null : $else) :$if;
    }

    public function getAll(){
        return $this->image->getAll();
    }

    public function getPaginate($nbPerPage, $section, $project){
        return  $this->getImages()
                ->where("sections.name","=",$section)
                ->where("projects.name","=",$project)
                ->orderBy('images.updated_at', 'DESC')
                ->paginate($nbPerPage);
    }

    private function getImages(){
        return DB::table('images')
                ->join('projects', 'images.project_id', '=', 'projects.id')
                ->join('sections', 'images.section_id', '=', 'sections.id')
                ->leftJoin('categories', 'images.category_id', '=', 'categories.id')
                ->select('images.name','images.*', 'categories.name as categoryName', 'projects.name as projectName', 'sections.name as sectionName');
    }

    public function getHomeLatest($type, $nb){
        $images = $this->getImages();
        if ($type == 'collection') {
            $images->orderBy('sections.updated_at', 'DESC')
                   ->groupBy('sections.name')
                   ->take($nb);
        }
        else{
            $images->orderBy('projects.updated_at', 'DESC')
                   ->groupBy('projects.name')
                   ->take($nb);
        }
        return $images->get();
    }

    public function getInstagramPosts($nb){
        $access_token="3190094976.1677ed0.093161ccf1974ae692d20f23a82e2135";
        $json_link="https://api.instagram.com/v1/users/self/media/recent/?";
        $json_link.="access_token={$access_token}&count={$nb}";
        if ($this->is_connected()) {
            $json = file_get_contents($json_link);
            $obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);
            $json = file_get_contents($json_link);
            $obj = json_decode(preg_replace('/("\w+"):(\d+)/', '\\1:"\\2"', $json), true);
            return $obj['data'];
        }
        else{
            return 404;
        }
    }
    
    public function getCategoriesByProject($project){
        return DB::table('categories')
                    ->join('images','categories.id','=','images.category_id')
                    ->join('projects','images.project_id','=','projects.id')
                    ->select('categories.id', 'categories.name')
                    ->where('projects.name', '=', $project)
                    ->groupBy('categories.name')
                    ->get();
    }

    public static function getRoutes(){
        // section/projet
        $data = DB::table('images')
                ->join('projects', 'images.project_id', '=', 'projects.id')
                ->join('sections', 'images.section_id', '=', 'sections.id')
                ->select('projects.name as projectName', 'sections.name as sectionName')
                ->distinct('sections.name', 'projects.name')
                ->get();
        $menu = [];
        foreach ($data as $val) {
            $menu[$val->sectionName][] = $val->projectName;
        }
        return $menu;
    }

    // public function globalDelete(Request $request){
    //     $section = $request->post('section');
    //     $project = $request->post('project');
    //     $category = $request->post('category');
    //     if ($section != null){
    //         $this->deleteSection($section);
    //     }
    //     if($project != null){
    //         $this->deleteProject($project);
    //     }
    //     if($category != null){
    //         $this->deleteCategory($category);
    //     }
    // }

    public function delete($id){
        $this->image->findOrFail($id)->delete();
        // delete image too
    }

    public function deleteSection($section){
        $sectionRepo = new section();
        $sectionRepo->findOrFail($section)->delete();
        // delete image too
    }

    public function deleteProject($project){
        $projectRepo = new project();
        $projectRepo->findOrFail($project)->delete();
        // delete image too
    }

    public function deleteCategory($category){
        $categoryRepo = new category();
        $categoryRepo->findOrFail($category)->delete();
        // delete image too
    }

    public function deleteAll(){
        
        // $categoryRepo->findOrFail($id)->delete();
    }

    function is_connected()
    {
        $connected = @fsockopen("www.instagram.com", 80); 
                                            //website, port  (try 80 or 443)
        if ($connected){
            $is_conn = true; //action when connected
            fclose($connected);
        }else{
            $is_conn = false; //action in connection failure
        }
        return $is_conn;
    
    }

}