<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ១. ពិនិត្យថា តើអ្នកប្រើប្រាស់បាន Login ហើយឬនៅ?
        // ២. ពិនិត្យថា តើ Role របស់អ្នកប្រើប្រាស់ជា 'super_admin' មែនឬទេ?
        // Allow both super_admin and admin roles to pass through if desired.
        if (Auth::check() && in_array(Auth::user()->role, ['super_admin', 'admin'])) {
            return $next($request);
        }

        // ប្រសិនបើមិនមែនជា Super Admin ទេ ឱ្យត្រឡប់ទៅទំព័រដើមវិញ (ឬទំព័រ Admin ធម្មតា)
        // អ្នកអាចប្តូរ '/' ទៅជា route('products.index') ក៏បាន
        return redirect('/')->with('error', 'អ្នកគ្មានសិទ្ធិអនុញ្ញាត (Permission) សម្រាប់មុខងារនេះទេ!');
    }
}