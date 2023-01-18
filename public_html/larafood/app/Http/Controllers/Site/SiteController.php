<?php

namespace App\Http\Controllers\Site; 

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    private $repository;
    
    public function __construct(Plan $plan) 
    {
        $this->repository = $plan;
    }
    
    public function index(){
        
        $plans = $this->repository->with('details')->orderBy('price','asc')->get();
        return view('site.pages.home.index',[
                    'title' => "Listagem de plano(s)",
                    'plans' => $plans
                ]
        );
        
    }
    
    public function plan($url)
    {
        //dd($url);
        if (!$plan = Plan::where('url', $url)->first()) {
            return redirect()->back();
        }

        session()->put('plan', $plan);

        return redirect()->route('register');
    }
}