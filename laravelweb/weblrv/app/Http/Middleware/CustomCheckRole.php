<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 

class CustomCheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
{
    $user = Auth::user();

    if (!$user || $user->is_admin != 1) {
        return redirect('dashboard');
    }
    session(['isAdmin' => true]);

    return $next($request);
}

    
    
}
