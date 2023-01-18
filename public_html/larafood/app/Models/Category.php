<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    protected $fillable = ['name','url','tenant_id','description'];
    
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    
    /**
     * Scope a query to only users by tenant
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTenantCategory(Builder $query)
    {
        return $query->where('tenant_id', auth()->user()->tenant_id);
    }

    /**
     * 
     * @param type $filter
     * @return type*
     * Faz a busca somente pela categoria com o id da empresa (tenant)
     */
    public function search($filter = null){
        
        $results = $this
                ->where("name", "LIKE", "%{$filter}%")
                ->orWhere("description", "LIKE", "%{$filter}%")
                ->latest()
                ->tenantCategory()//função que faz busca somente pela categoria relacionada a essa empresa
                ->paginate();
                
                return $results;
    }
}
