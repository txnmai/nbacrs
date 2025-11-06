@extends('layout')
@section('title')
ไม่ได้รับอนุญาติ - ระบบแจ้งซ่อมอุปกรณ์คอมพิวเตอร์
@endsection

@section('content')
<div class="container mx-auto px-4 py-8 h-[80vh] flex items-center justify-center">
    <div class="text-center">
        <div class="mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-red-100 rounded-full mb-6">
                <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H10m2-10V7m0 0V5m0 2h2m-2 0H10"/>
                </svg>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8 max-w-md mx-auto">
            <div class="text-center mb-6">
                <h2 class="text-xl font-semibold text-slate-800 mb-2">
                    Not Authorized - ไม่ได้รับอนุญาติ
                </h2>
                <p class="text-slate-600">
                    Only administrators are allowed to access this system.
                </p>
            </div>
            
            <div class="space-y-4">
                <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <p class="text-sm text-blue-800">
                        <strong>ต้องการเข้าใช้งาน?</strong><br>
                        กรุณาติดต่อเจ้าหน้าที่ IT เพื่อขอสิทธิ์การเข้าใช้งาน
                    </p>
                </div>
                
            </div>
        </div>
        
        <div class="mt-8">
            <p class="text-sm text-slate-600">
                © 2024 ระบบแจ้งซ่อมอุปกรณ์คอมพิวเตอร์ - โรงเรียน
            </p>
        </div>
    </div>
</div>
@endsection