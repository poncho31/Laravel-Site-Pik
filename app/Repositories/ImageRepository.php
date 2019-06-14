<?php
namespace App\Repositories;
use App\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;
use App\category;
use Illuminate\Support\Facades\DB;
use App\project;
use App\section;

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

        // dd($section, $project, $category);
        // dd("section".intval($section), "project".intval($project),"category". intval($category));
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
        // dd($section);
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
                ->join('categories', 'images.category_id', '=', 'categories.id')
                ->select('images.name','images.*', 'categories.name as categoryName', 'projects.name as projectName', 'sections.name as sectionName');
    }

    public function getHomeLatest($type){
        $images = $this->getImages();
        if ($type == 'collection') {
            $images->orderBy('sections.updated_at', 'DESC')
                   ->take(4);
        }
        else{
            $images->orderBy('projects.updated_at', 'DESC')
                   ->take(4);
        }
        // $images->select('images.*');
        return $images->get();
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
        // dd($data);
        // dd($menu);
                // SELECT DISTINCT s.name as sectionName, GROUP_CONCAT(DISTINCT p.name SEPARATOR '/') as projectName FROM images i
                // INNER JOIN sections s ON s.id = i.section_id
                // INNER JOIN projects p ON p.id = i.project_id
                // GROUP BY sectionName
    }
}