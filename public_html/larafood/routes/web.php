<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    PlanController, 
    DetailPlanController,
    ProfileController,
    PermissionController,
    PermissionProfileController,
    UserController,
    CategoryController,
    ProductController,
    CategoryProductController,
    TableController,
    PlanProfileController,
    TenantController,
    RoleUserController,
    PermissionRoleController,
    RoleController
};

use App\Http\Controllers\Site\{
    SiteController
};


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')
        ->namespace('Admin')
        ->middleware(['auth'])
        ->group(function(){
            
            Route::get('teste-acl', function(){
                dd(auth()->user()->permissions());
            });
            
            
            /**
             * Cargo x usuario
             */
            Route::get('users/{id}/role/{idRole}/detach', [RoleUserController::class, 'detachRoleUser'])->name('users.role.detach');
            Route::post('users/{id}/roles', [RoleUserController::class, 'attachRolesUser'])->name('users.roles.attach');
            Route::any('users/{id}/roles/create', [RoleUserController::class, 'rolesAvailable'])->name('users.roles.available');
            Route::get('users/{id}/roles', [RoleUserController::class, 'roles'])->name('users.roles');
            Route::get('roles/{id}/users', [RoleUserController::class, 'users'])->name('roles.users');

            /**
             * Permissão x Cargo
             */
            Route::get('roles/{id}/permission/{idPermission}/detach', [PermissionRoleController::class, 'detachPermissionRole'])->name('roles.permission.detach');
            Route::post('roles/{id}/permissions', [PermissionRoleController::class, 'attachPermissionsRole'])->name('roles.permissions.attach');
            Route::any('roles/{id}/permissions/create', [PermissionRoleController::class, 'permissionsAvailable'])->name('roles.permissions.available');
            Route::get('roles/{id}/permissions', [PermissionRoleController::class, 'permissions'])->name('roles.permissions');
            Route::get('permissions/{id}/role', [PermissionRoleController::class, 'roles'])->name('permissions.roles');
                  
            /**
            * Rota Perfil
            */
            Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
            Route::any('roles/search', [RoleController::class, 'search'])->name('roles.search');
            Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store');
            Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
            Route::get('roles/{id}', [RoleController::class, 'show'])->name('roles.show');
            Route::delete('roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
            Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
            Route::put('roles/{id}', [RoleController::class, 'update'])->name('roles.update');
            

            /*Empresas*/
            Route::get('tenants/create', [TenantController::class, 'create'])->name('tenants.create');
            Route::any('tenants/search', [TenantController::class, 'search'])->name('tenants.search');
            Route::post('tenants/store', [TenantController::class, 'store'])->name('tenants.store');
            Route::get('tenants', [TenantController::class, 'index'])->name('tenants.index');
            Route::get('tenants/{id}', [TenantController::class, 'show'])->name('tenants.show');
            Route::delete('tenants/{id}', [TenantController::class, 'destroy'])->name('tenants.destroy');
            Route::get('tenants/{id}/edit', [TenantController::class, 'edit'])->name('tenants.edit');
            Route::put('tenants/{id}', [TenantController::class, 'update'])->name('tenants.update');
            
            /*Mesas*/
            Route::get('tables/create', [TableController::class, 'create'])->name('tables.create');
            Route::any('tables/search', [TableController::class, 'search'])->name('tables.search');
            Route::post('tables/store', [TableController::class, 'store'])->name('tables.store');
            Route::get('tables', [TableController::class, 'index'])->name('tables.index');
            Route::get('tables/{id}', [TableController::class, 'show'])->name('tables.show');
            Route::delete('tables/{id}', [TableController::class, 'destroy'])->name('tables.destroy');
            Route::get('tables/{url}/edit', [TableController::class, 'edit'])->name('tables.edit');
            Route::put('tables/{url}', [TableController::class, 'update'])->name('tables.update');
            
            /*Categorias*/
            Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
            Route::any('categories/search', [CategoryController::class, 'search'])->name('categories.search');
            Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
            Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
            Route::get('categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
            Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
            Route::get('categories/{url}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::put('categories/{url}', [CategoryController::class, 'update'])->name('categories.update');
            
            /*Produtos*/
            Route::get('products/create', [ProductController ::class, 'create'])->name('products.create');
            Route::any('products/search', [ProductController ::class, 'search'])->name('products.search');
            Route::post('products/store', [ProductController ::class, 'store'])->name('products.store');
            Route::get('products', [ProductController ::class, 'index'])->name('products.index');
            Route::get('products/{id}', [ProductController ::class, 'show'])->name('products.show');
            Route::delete('products/{id}', [ProductController ::class, 'destroy'])->name('products.destroy');
            Route::get('products/{url}/edit', [ProductController ::class, 'edit'])->name('products.edit');
            Route::put('products/{url}', [ProductController ::class, 'update'])->name('products.update');
            
            /*Produto x Categoria */
            Route::get('products/{id}/category/{idCategory}/detach', [CategoryProductController::class, 'detachCategoryProduct'])->name('products.category.detach');
            Route::post('products/{id}/categories', [CategoryProductController::class, 'attachCategoriesProduct'])->name('products.categories.attach');
            Route::any('products/{id}/categories/create', [CategoryProductController::class, 'categoriesAvailable'])->name('products.categories.available');
            Route::get('products/{id}/categories', [CategoryProductController::class, 'categories'])->name('products.categories');
            Route::get('categories/{id}/products', [CategoryProductController::class, 'products'])->name('categories.products');

            /*Detalhes do plano*/
            Route::post('plans/{url}/details', [DetailPlanController::class, 'store'])->name('details.plan.store');
            Route::delete('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'destroy'])->name('details.plan.destroy');
            Route::get('plans/{url}/create', [DetailPlanController::class, 'create'])->name('details.plan.create');
            Route::get('plans/{url}/details', [DetailPlanController::class, 'index'])->name('details.plan.index');
            
            /*Planos*/
            Route::get('plans/create', [PlanController::class, 'create'])->name('plans.create');
            Route::any('plans/search', [PlanController::class, 'search'])->name('plans.search');
            Route::post('plans/store', [PlanController::class, 'store'])->name('plans.store');
            Route::get('plans', [PlanController::class, 'index'])->name('plans.index');
            Route::get('plans/{id}', [PlanController::class, 'show'])->name('plans.show');
            Route::delete('plans/{id}', [PlanController::class, 'destroy'])->name('plans.destroy');
            Route::get('plans/{url}/edit', [PlanController::class, 'edit'])->name('plans.edit');
            Route::put('plans/{url}', [PlanController::class, 'update'])->name('plans.update');
            Route::get('plans/{id}/profiles', [PlanController::class, 'permissions'])->name('plans.profiles');
            
            /* Plano x Perfil*/
            Route::get('plans/{id}/profile/{idProfile}/detach', [PlanProfileController::class, 'detachProfilePlan'])->name('plans.profile.detach');
            Route::post('plans/{id}/profiles', [PlanProfileController::class, 'attachProfilesPlan'])->name('plans.profiles.attach');
            Route::any('plans/{id}/profiles/create', [PlanProfileController::class, 'profilesAvailable'])->name('plans.profiles.available');
            Route::get('plans/{id}/profiles', [PlanProfileController::class, 'profiles'])->name('plans.profiles');
            Route::get('profiles/{id}/plans', [PlanProfileController::class, 'plans'])->name('profiles.plans');

             
            /*Perfil(s)*/
            Route::get('profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
            Route::any('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
            Route::post('profiles/store', [ProfileController::class, 'store'])->name('profiles.store');
            Route::get('profiles', [ProfileController::class, 'index'])->name('profiles.index');
            Route::get('profiles/{id}', [ProfileController::class, 'show'])->name('profiles.show');
            Route::delete('profiles/{id}', [ProfileController::class, 'destroy'])->name('profiles.destroy');
            Route::get('profiles/{url}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
            Route::put('profiles/{url}', [ProfileController::class, 'update'])->name('profiles.update');
            
            /*Permissão perfil*/
            Route::post('profiles/{id}/permissions', [PermissionProfileController::class, 'attachPermissionsProfile'])->name('profiles.permissions.attach');
            Route::get('profiles/{id}/permission{idPermissin}/detach', [PermissionProfileController::class, 'detachPermissionsProfile'])->name('profiles.permissions.detach');
            Route::get('profiles/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profiles.permissions.available');
            Route::get('profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions');
            
            /*Usuario(s)*/
            Route::get('users/create', [UserController::class, 'create'])->name('users.create');
            Route::any('users/search', [UserController::class, 'search'])->name('users.search');
            Route::post('users/store', [UserController::class, 'store'])->name('users.store');
            Route::get('users', [UserController::class, 'index'])->name('users.index');
            Route::get('users/{id}', [UserController::class, 'show'])->name('users.show');
            Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
            Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
                 
            /*Permissão(s)*/
            Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
            Route::any('permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
            Route::post('permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
            Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
            Route::get('permissions/{id}', [PermissionController::class, 'show'])->name('permissions.show');
            Route::delete('permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
            Route::get('permissions/{url}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
            Route::put('permissions/{url}', [PermissionController::class, 'update'])->name('permissions.update');
             
        });
        
        /*Site*/
        Route::namespace('Site')
                ->group(function(){    
             Route::get('/', [SiteController::class, 'index'])->name('site.home'); 
             Route::get('/plan/{url}', [SiteController::class, 'plan'])->name('plan.subscription');
        });

require __DIR__.'/auth.php';