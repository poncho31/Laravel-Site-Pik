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
        
        foreach ($request->file('image') as $imageFile) {
            // Save image
            $path = Storage::disk('images')->put('', $imageFile);
            // Save thumb
            $image = InterventionImage::make($imageFile)->widen(500);
            Storage::disk('thumbs')->put($path, $image->encode());
            // Save in base
            $this->image = new Image();
            $this->image->description = $request->description;
            $this->image->category_id = $request->category_id;
            $this->image->name = $path;
            $this->image->user_id = auth()->id();
            $this->image->save();
        }
        
    }

    public function getAll(){
        return $this->image->getAll();
    }
    public function getPaginate($nbPerPage, $category){
        return DB::table('images')
                ->join('categories', 'images.category_id', '=', 'categories.id')
                ->select('categories.name as categoryName', 'images.*')
                ->where("categories.name",$category)
                ->orderBy('images.id', 'DESC')
                ->paginate($nbPerPage);
    }

    public function getByCategory($cat){
        return $this->image::where('category', $cat)
                            ->orderBy('updated_at')
                            ->get();
    }
}