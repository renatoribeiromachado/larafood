<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\StoreUpdateCategory;

class CategoryController extends Controller
{
    private $repository;
    
    public function __construct(Category $category) 
    {
        $this->repository = $category;
    }
    
    public function index(){
        
        $categories = $this->repository->latest()->tenantCategory()->paginate();
        return view('admin.pages.categories.index',[
                    'title' => "Listagem de Categorias",
                    'categories' => $categories
                ]
        );
        
    }
    
    public function create(){
        
        return view('admin.pages.categories.create');
        
    }
    
    public function store(StoreUpdateCategory $request){
        
        $data = $request->all();
        $data['url'] = Str::slug($request->name);
        $data['tenant_id'] = auth()->user()->tenant_id;
        $this->repository->create($data);
        return redirect()->route('categories.index');
        
    }
    
    public function show($url = null){
        
        $category = $this->repository->where('url', $url)->first();
        if(!$category)
        return redirect()->back();

        return view('admin.pages.categories.show',[
            'title' => "Detalhes da Categoria",
            'category' => $category
        ]);
        
    }
    
    public function edit($url = null){
        
        $category = $this->repository->where('url', $url)->first();
        if(!$category)
        return redirect()->back();

        return view('admin.pages.categories.edit',[
            'title' => "Atualizando Categoria",
            'category' => $category
        ]);
        
    }
    
    public function update(StoreUpdateCategory $request, $url = null){
        
        $category = $this->repository->where('url', $url)->first();
        if(!$category)
        return redirect()->back();
        
        $data = $request->all();
        $data['url'] = Str::slug($request->name);

        $category->update($data);
        return redirect()->route('categories.index');
        
    }
    
    public function search(Request $request){
        
        $filters = request()->except('_token');
        $categories = $this->repository->search($request->filter);
        return view('admin.pages.categories.index',[
                    'title' => "Listagem de Categorias",
                    'filters' => $filters,
                    'categories' => $categories
                ]
        );
        
    }
    
    public function destroy($url = null){
        
        $category = $this->repository->where('url', $url)->first();
        if(!$category)
        return redirect()->back();

        $category->delete();
        return redirect()->route('categories.index');
        
    }
    
}