<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Profile;

class PermissionProfileController extends Controller
{
    private $profile, $permission;
    
    public function __construct(Profile $profile, Permission $permission) 
    {
        $this->profile = $profile;
        $this->permission = $permission;
    }
    
    public function permissions($idProfile = null){
        
        $profile = $this->profile->find($idProfile);
        if(!$profile){
            return redirect()->back();
        }
        
        $permissions = $profile->permissions()->paginate();
        
        return view('admin.pages.profiles.permissions.permissions',[
            'title' => "Permissões do perfil",
            'profile' => $profile,
            'permissions' => $permissions,
        ]);
        
    } 
    
    public function permissionsAvailable($idProfile){
        
   
        $profile = $this->profile->find($idProfile);
        if(!$profile){
            return redirect()->back();
        }
        
        //$permissions = $this->permission->paginate();
        
        $permissions = $profile->permissionsAvailable();
        
        return view('admin.pages.profiles.permissions.available',[
            'title' => "Permissões disponivel para o perfil",
            'profile' => $profile,
            'permissions' => $permissions,
        ]);
        
    }
    
     public function attachPermissionsProfile(Request $request, $idProfile){
        
        //dd($request->permissions);

        if(!$profile = $this->profile->find($idProfile)){
            return redirect()->back();
        }
        
        if(!$request->permissions || count($request->permissions) == 0){
            return redirect()
                    ->back()
                    ->with('info', "É necessário selecionar ao menos uma permissão");
        }
        
        $profile->permissions()->attach($request->permissions);
        
        return redirect()->route('profiles.permissions', $profile->id);
        
    }
    
    public function detachPermissionsProfile($idProfile, $idPermission){
        
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if(!$profile || !$permission){
            return redirect()->back();
        }
        
        $profile->permissions()->detach($permission);
        
        return redirect()->route('profiles.permissions', $profile->id);
        
    }
}