<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailPlan;
use App\Models\Plan;

class DetailPlanController extends Controller
{
    
    protected $repository, $plan;
    
    public function __construct(DetailPlan $detailsPlan, Plan $plan) 
    {
        $this->repository = $detailsPlan;
        $this->plan       = $plan;
    }
    
    public function index($urlPlan = null)
    {
        if(!$plan = $this->plan->where('url',$urlPlan )->first())
        {
            return redirect()->back();
        }
        
        $details = $plan->details()->paginate();
        
        return view('admin.pages.plans.details.index',[
            "title" => "Detalhes do Plano - {$plan->name}",
            "plan"    => $plan,
            "details" => $details
        ]);
    }
    
    public function create($urlPlan)
    {
        if(!$plan = $this->plan->where('url',$urlPlan )->first())
        {
           return redirect()->back(); 
        }
        return view('admin.pages.plans.details.create',[
            'plan' => $plan,
        ]);
    }
    
    public function store(Request $request, $urlPlan)
    {
        if(!$plan = $this->plan->where('url',$urlPlan )->first())
        {
           return redirect()->back(); 
        }
        $data = $request->all();
        $data['plan_id'] = $plan->id;
        $this->repository->create($data);
        
        $details = $plan->details()->paginate();
        
        return view('admin.pages.plans.details.index',[
            "title" => "Detalhes do Plano - {$plan->name}",
            "plan"    => $plan,
            "details" => $details
        ]);
    }
    
    public function destroy($urlPlan = null, $idPlan = null){
        
        //dd($idPlan);
        if(!$planDetail = $this->repository->where('id',$idPlan )->first())
        {
           return redirect()->back(); 
        }
        if(!$plan = $this->plan->where('url',$urlPlan )->first())
        {
            return redirect()->back();
        }
        
        $planDetail->delete();
        
        $details = $plan->details()->paginate();
        
        return view('admin.pages.plans.details.index',[
            "title" => "Detalhes do Plano - {$plan->name}",
            "plan"    => $plan,
            "details" => $details
        ]);
        
    }
}
