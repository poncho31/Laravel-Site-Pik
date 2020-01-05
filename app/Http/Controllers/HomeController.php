<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Facades\Instagram;
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
        $lastProject = $this->imageRepo->getHomeLatest('project', 4);
        $lastCollection = $this->imageRepo->getHomeLatest('collection', 4);
        $instagram= $this->imageRepo->getInstagramPosts(4);
        
        return view('home', compact('lastProject', 
                                    'lastCollection', 
                                    'instagram'
                                ));
    }

    public function aboutMe()
    {
        return view('aboutme');
    }

    function fetchData($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
