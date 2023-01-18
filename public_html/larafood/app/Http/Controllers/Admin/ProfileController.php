<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Http\Requests\StoreUpdateProfile;

class ProfileController extends Controller
{
    private $repository;
    
    public function __construct(Profile $profile) 
    {
        $this->repository = $profile;
    }
    
    public function index(){
        
        $profiles = $this->repository->paginate();
        return view('admin.pages.profiles.index',[
                    'title' => "Listagem de perfil(s)",
                    'profiles' => $profiles
                ]
        );
        
    }
    
    public function create(){
        
        return view('admin.pages.profiles.create');
        
    }
    
    public function store(StoreUpdateProfile $request){
        
        $data = $request->all();
        $this->repository->create($data);
        return redirect()->route('profiles.index');
        
    }
    
    public function show($id = null){
        
        $profile = $this->repository->where('id', $id)->first();
        if(!$profile)
        return redirect()->back();

        return view('admin.pages.profiles.show',[
            'title' => "Detalhes do perfil",
            'profile' => $profile
        ]);
        
    }
    
    public function edit($id = null){
        
        $profile = $this->repository->where('id', $id)->first();
        if(!$profile)
        return redirect()->back();

        return view('admin.pages.profiles.edit',[
            'title' => "Atualizando perfil",
            'profile' => $profile
        ]);
        
    }
    
    public function update(StoreUpdateProfile $request, $id = null){
        
        $profile = $this->repository->where('id', $id)->first();
        if(!$profile)
        return redirect()->back();
        
        $data = $request->all();

        $profile->update($data);
        return redirect()->route('profiles.index');
        
    }
    
    public function search(Request $request){
        
        $filters = request()->except('_token');
        $profiles = $this->repository->search($request->filter);
        return view('admin.pages.profiles.index',[
                    'title' => "Listagem de perfil(s)",
                    'filters' => $filters,
                    'profiles' => $profiles
                ]
        );
        
    }
    
    public function destroy($id = null){
        
        $profile = $this->repository->where('id', $id)->first();
        if(!$profile)
        return redirect()->back();

        $profile->delete();
        return redirect()->route('profiles.index');
        
    }
    
}