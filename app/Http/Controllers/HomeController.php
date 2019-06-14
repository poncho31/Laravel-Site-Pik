<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\ImageRepository;

class HomeController extends Controller
{
    protected $imageRepo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ImageRepository $imageRepo)
    {
        $this->imageRepo = $imageRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastProject = $this->imageRepo->getHomeLatest('project');
        $lastCollection = $this->imageRepo->getHomeLatest('collection');
        return view('home', compact('lastProject', 'lastCollection'));
    }

    public function aboutMe()
    {
        return view('aboutme');
    }

}
