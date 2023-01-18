<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUpdateUser;

class UserController extends Controller
{
    private $repository;
    
    public function __construct(User $user) 
    {
        $this->repository = $user;
    }
    
    public function index(){
        
        $users = $this->repository->latest()->tenantUser()->paginate();
        return view('admin.pages.users.index',[
                    'title' => "Listagem de usuario(s)",
                    'users' => $users
                ]
        );
        
    }
    
    public function create(){
        
        return view('admin.pages.users.create');
        
    }
    
    public function store(StoreUpdateUser $request){
        
        $data = $request->all();
        $data['tenant_id'] = auth()->user()->tenant_id;
        $data['password'] = bcrypt($data['password']); // encrypt password

        $this->repository->create($data);

        return redirect()->route('users.index');
        
    }
    
    public function show($id = null){
        
        if (!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.users.show',[
            'title' => "Detalhes do usuario",
            'user' => $user
        ]);
        
    }
    
    public function edit($id = null){
        
        if (!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }


        return view('admin.pages.users.edit',[
            'title' => "Atualizando usuario",
            'user' => $user
        ]);
        
    }
    
    public function update(StoreUpdateUser $request, $id)
    {
        if (!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        $data = $request->only(['name', 'email']);

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index');
    }
    
    public function search(Request $request){
        
        $filters = request()->except('_token');
        $users = $this->repository->search($request->filter);
        return view('admin.pages.users.index',[
                    'title' => "Listagem de usuario(s)",
                    'filters' => $filters,
                    'users' => $users
                ]
        );
        
    }
    
    public function destroy($id = null){
        
        if (!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        $user->delete();
        return redirect()->route('users.index');
        
    }
    
}