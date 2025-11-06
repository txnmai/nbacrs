@extends('layout')
@section('title')
Admin Login - ระบบแจ้งซ่อมอุปกรณ์คอมพิวเตอร์
@endsection

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-500 text-white rounded-full mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-slate-800 mb-2">
                    ระบบแจ้งซ่อมอุปกรณ์คอมพิวเตอร์
                </h1>
                <p class="text-slate-600">เข้าสู่ระบบสำหรับผู้ดูแลระบบ</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8">
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-slate-800 mb-1">เข้าสู่ระบบ</h2>
                    <p class="text-sm text-slate-600">กรอกข้อมูลเพื่อเข้าใช้งานระบบ</p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-red-600 text-sm">{{ $errors->first() }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.attempt') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            ชื่อผู้ใช้
                        </label>
                        <input type="text" 
                               name="name" 
                               placeholder="กรอกชื่อผู้ใช้" 
                               class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            รหัสผ่าน
                        </label>
                        <input type="password" 
                               name="password" 
                               placeholder="กรอกรหัสผ่าน" 
                               class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                               required>
                    </div>

                    <button type="submit" 
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-4 rounded-lg transition duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        เข้าสู่ระบบ
                    </button>
                </form>

                <div class="mt-6 pt-6 border-t border-slate-200">
                    <p class="text-xs text-slate-500 text-center">
                        สำหรับเจ้าหน้าที่ IT เท่านั้น
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection