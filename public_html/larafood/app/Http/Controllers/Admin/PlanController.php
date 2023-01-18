<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Str;
use App\Http\Requests\StoreUpdatePlan;

class PlanController extends Controller
{
    private $repository;
    
    public function __construct(Plan $plan) 
    {
        $this->repository = $plan;
    }
    
    public function index(){
        
        $plans = $this->repository->paginate();
        return view('admin.pages.plans.index',[
                    'title' => "Listagem de Planos",
                    'plans' => $plans
                ]
        );
        
    }
    
    public function create(){
        
        return view('admin.pages.plans.create');
        
    }
    
    public function store(StoreUpdatePlan $request){
        
        $data = $request->all();
        $data['url'] = Str::slug($request->name);
        $this->repository->create($data);
        return redirect()->route('plans.index');
        
    }
    
    public function show($url = null){
        
        $plan = $this->repository->where('url', $url)->first();
        if(!$plan)
        return redirect()->back();

        return view('admin.pages.plans.show',[
            'title' => "Detalhes do Plano",
            'plan' => $plan
        ]);
        
    }
    
    public function edit($url = null){
        
        $plan = $this->repository->where('url', $url)->first();
        if(!$plan)
        return redirect()->back();

        return view('admin.pages.plans.edit',[
            'title' => "Atualizando Plano",
            'plan' => $plan
        ]);
        
    }
    
    public function update(StoreUpdatePlan $request, $url = null){
        
        $plan = $this->repository->where('url', $url)->first();
        if(!$plan)
        return redirect()->back();
        
        $data = $request->all();
        $data['url'] = Str::slug($request->name);

        $plan->update($data);
        return redirect()->route('plans.index');
        
    }
    
    public function search(Request $request){
        
        $filters = request()->except('_token');
        $plans = $this->repository->search($request->filter);
        return view('admin.pages.plans.index',[
                    'title' => "Listagem de Planos",
                    'filters' => $filters,
                    'plans' => $plans
                ]
        );
        
    }
    
    public function destroy($url = null){
        
        $plan = $this->repository->where('url', $url)->first();
        if(!$plan)
        return redirect()->back();

        $plan->delete();
        return redirect()->route('plans.index');
        
    }
    
}