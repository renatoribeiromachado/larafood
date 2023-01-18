<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Services\TenantService;
use App\Tenant\Events\TenantCreated;


class RegisteredUserController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';
    
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        
        //dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'empresa' => ['required', 'string', 'min:3', 'max:255', 'unique:tenants,name'],
            'cnpj' => ['required', 'numeric', 'digits:14', 'unique:tenants'],
        ]);

        if (!$plan = session('plan')) {
            return redirect()->route('site.home');
        }

        $tenant = $plan->tenants()->create([
            'cnpj' => $request->cnpj,
            'name' => $request->empresa,
            'url' => Str::slug($request->empresa),
            'email' => $request->email,
            'active' => 1,
            'subscription' => now(),
            'expires_at' => now()->addDays(7),
        ]);
        
        $user = $tenant->users()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), 
        ]);
        
        $tenantService = app(TenantService::class);
        $usuario = $tenantService->make($plan, $request);

        event(new TenantCreated($usuario));

        //return $user;
        
        return redirect()->route('plans.index');
    }
}
