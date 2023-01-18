<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Http\Requests\StoreUpdatePermission;

class PermissionController extends Controller
{
    private $repository;
    
    public function __construct(Permission $permission) 
    {
        $this->repository = $permission;
    }
    
    public function index(){
        
        $permissions = $this->repository->paginate();
        return view('admin.pages.permissions.index',[
                    'title' => "Listagem de permissão(s)",
                    'permissions' => $permissions
                ]
        );
        
    }
    
    public function create(){
        
        return view('admin.pages.permissions.create');
        
    }
    
    public function store(StoreUpdatePermission $request){
        
        $data = $request->all();
        $this->repository->create($data);
        return redirect()->route('permissions.index');
        
    }
    
    public function show($id = null){
        
        $permission = $this->repository->where('id', $id)->first();
        if(!$permission)
        return redirect()->back();

        return view('admin.pages.permissions.show',[
            'title' => "Detalhes da permissão",
            'permission' => $permission
        ]);
        
    }
    
    public function edit($id = null){
        
        $permission = $this->repository->where('id', $id)->first();
        if(!$permission)
        return redirect()->back();

        return view('admin.pages.permissions.edit',[
            'title' => "Atualizando permissão",
            'permission' => $permission
        ]);
        
    }
    
    public function update(StoreUpdatePermission $request, $id = null){
        
        $permission = $this->repository->where('id', $id)->first();
        if(!$permission)
        return redirect()->back();
        
        $data = $request->all();

        $permission->update($data);
        return redirect()->route('permissions.index');
        
    }
    
    public function search(Request $request){
        
        $filters = request()->except('_token');
        $permissions = $this->repository->search($request->filter);
        return view('admin.pages.permissions.index',[
                    'title' => "Listagem de permissão(s)",
                    'filters' => $filters,
                    'permissions' => $permissions
                ]
        );
        
    }
    
    public function destroy($id = null){
        
        $permission = $this->repository->where('id', $id)->first();
        if(!$permission)
        return redirect()->back();

        $permission->delete();
        return redirect()->route('permissions.index');
        
    }
    
}