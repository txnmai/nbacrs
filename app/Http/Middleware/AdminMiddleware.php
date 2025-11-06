<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;

class AdminMiddleware
{
    /**
     * จัดการคำขอที่เข้ามา
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // ถ้าผู้ใช้ไม่ได้ล็อกอิน แสดงหน้าไม่อนุญาตให้เข้า
            return response()->view('verifyfail');
        }

        return $next($request);
    }
}