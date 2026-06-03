<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $adminEmail = Setting::getValue('admin_email');

        if (!$adminEmail || auth()->user()->email !== $adminEmail) {
            abort(403);
        }

        return $next($request);
    }
}
