<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CancerModel;
class HomeController extends Controller
{
  
    /* public function __construct()
    {
        $this->middleware('guest');
    } */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $cancerTypes =  (new CancerModel)->getActiveCancerTypes()->toArray();
        return view('frontend.home',['cancerTypes'=>$cancerTypes]);
    }
}
