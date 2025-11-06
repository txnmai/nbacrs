<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request){
    if (! $request->expectsJson()) {
        return '/verifyfail'; // หรือจะเป็น '/info' หรือหน้าอะไรก็ได้ที่คุณต้องการ
    }
    return null; // ถ้าไม่ต้องการ redirect ให้คืนค่า null
}
}
