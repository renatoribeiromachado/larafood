<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name','description'];
    
    
    public function profiles(){
        
        return $this->belongsToMany(Profile::class); 
    }
    
    public function search($filter = null){
        
        $results = $this
                ->where("name", "LIKE", "%{$filter}%")
                ->orWhere("description", "LIKE", "%{$filter}%")
                ->paginate();
                
                return $results;
    }
}
