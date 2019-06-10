<?php
namespace App\Repositories;
use App\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;
use App\category;
use Illuminate\Support\Facades\DB;

class ImageRepository
{
    protected $image;
    protected $category;
    public function __construct(Image $image, category $category){
        $this->image = $image;
        $this->category = $category;
    }

    public function store($request)
    {
        $section = $this->ifElse($request->post('category_section'), $request->post('category_section_new'));
        $project = $this->ifElse($request->post('category_project'), $request->post('category_project_new'));
        $category = $this->ifElse($request->post('category_name'),  $request->post('category_name_new'));

        if ($section != $project || $section != $category || $project != $category) {
            // ajout dans la table categorie si id des 3 ne sont pas les mêmes
            $this->category = new category();
            $this->category->name = is_numeric($category)?$this->category->find($category):$category;
            $this->category->project = is_numeric($project)? $this->project->find($project):$project;
            $this->category->section = is_numeric($section)?$this->section->find($section):$section;
            $this->category->save();
            $category = $this->category->id;
        }
        foreach ($request->file('image') as $imageFile) {

            // Save image
            $path = Storage::disk('images')->put("/$section/$project/$category", $imageFile);
            // Save thumb
            $image = InterventionImage::make($imageFile)->widen(500);
            Storage::disk('thumbs')->put($path, $image->encode());
            // Save in base
            $this->image = new Image();
            $this->image->description = $request->description;
            $this->image->category_id = $category;
            $this->image->name = $path;
            $this->image->user_id = auth()->id();
            $this->image->save();
        }
        
    }

    private function ifElse($if, $else){
        return $if == NULL ? ($else == null ? null : $else) :$if;
    }

    public function getAll(){
        return $this->image->getAll();
    }

    public function getPaginate($nbPerPage, $section, $project, $category){
        $filteredImages =  DB::table('images')
                ->join('categories', 'images.category_id', '=', 'categories.id')
                ->select('categories.section as categoryName', 'images.*')
                ->where("categories.section",$section)
                ->where("categories.project",$project);
        if (!empty($category)) {
            $filteredImages->where("categories.name",$category);
        }

        return $filteredImages->orderBy('images.id', 'DESC')
                ->paginate($nbPerPage);
    }

    public function getByCategory($cat){
        return $this->image::where('category', $cat)
                            ->orderBy('updated_at')
                            ->get();
    }
}