<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * รายการ exception ที่ไม่ต้องรายงาน
     */
    protected $dontReport = [];

    /**
     * รายการ input ที่ไม่ควรรวมใน validation exceptions
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * รายงานหรือจัดการ exception
     */
    public function register(): void
    {
        //
    }

    /**
     * สำหรับ redirect ถ้ายังไม่ได้ login
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $exception->getMessage()], 401);
        }

        return redirect()->route('verifyfail'); // แก้ตรงนี้ตาม route ที่คุณต้องการ
    }
}
