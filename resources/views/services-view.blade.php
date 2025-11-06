@extends('layout')
@section('title')
Services DMS
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-gray-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent mb-4">
                Services Management
            </h1>
            <p class="text-gray-600 text-lg">ระบบจัดการคำขอแจ้งซ่อม</p>
        </div>

        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="stats shadow-lg bg-white border border-blue-100">
                <div class="stat">
                    <div class="stat-figure text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="stat-title text-gray-600">รายการทั้งหมด</div>
                    <div class="stat-value text-blue-600">{{ count($serviceusers) }}</div>
                </div>
            </div>
            <div class="stats shadow-lg bg-white border border-blue-100">
                <div class="stat">
                    <div class="stat-figure text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <div class="stat-title text-gray-600">รายการที่ยังไม่เสร็จ</div>
                    <div class="stat-value text-red-600">{{ $unsuccesstask }}</div>
                </div>
            </div>
            <div class="stats shadow-lg bg-white border border-blue-100">
                <div class="stat">
                    <div class="stat-figure text-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="stat-title text-gray-600">รายการที่เสร็จแล้ว</div>
                    <div class="stat-value text-green-600">{{ $successtask }}</div>
                </div>
            </div>
        </div>

        <!-- Main Table Card -->
        <div class="card bg-white shadow-xl border border-blue-100">
            <div class="card-body p-0">
                <!-- Table Header -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-t-2xl">
                    <h2 class="text-2xl font-bold flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        รายการคำขอแจ้งซ่อม
                    </h2>
                </div>

                <!-- Responsive Table -->
                <div class="overflow-x-auto">
                    <!-- Desktop Table -->
                    <div class="hidden lg:block">
                        <table class="table table-zebra w-full">
                            <thead class="bg-gray-50">
                                <tr class="text-center">
                                    <th class="text-gray-700 font-semibold">ชื่อผู้แจ้งซ่อม</th>
                                    <th class="text-gray-700 font-semibold">สิ่งที่ต้องซ่อม</th>
                                    <th class="text-gray-700 font-semibold">รายละเอียด</th>
                                    <th class="text-gray-700 font-semibold">สถานที่</th>
                                    <th class="text-gray-700 font-semibold">วันกำหนดส่งงาน</th>
                                    <th class="text-gray-700 font-semibold">วันส่งคำขอ</th>
                                    <th class="text-gray-700 font-semibold">สถานะงาน</th>
                                    <th class="text-gray-700 font-semibold">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($serviceusers as $serviceuser)
                                <tr class="text-center hover:bg-blue-50 transition-colors">
                                    <td class="font-medium text-gray-800">{{$serviceuser->name}}</td>
                                    <td class="text-gray-700">{{$serviceuser->itemrepair}}</td>
                                    <td class="text-gray-600 max-w-xs truncate" title="{{$serviceuser->detailrepair}}">{{$serviceuser->detailrepair}}</td>
                                    <td class="text-gray-700">{{$serviceuser->location}}</td>
                                    <td class="text-gray-700">
                                        <span class="badge badge-outline badge-info">{{$serviceuser->date}}</span>
                                    </td>
                                    <td class="text-gray-700">
                                        <span class="badge badge-outline badge-secondary">{{\Carbon\Carbon::parse($serviceuser->created_at)->format('Y-m-d')}}</span>
                                    </td>
                                    <td class="text-gray-700">
                                    <label class="swap">
                                        <input type="checkbox" class="toggle-active" data-id="{{ $serviceuser->id }}" {{ $serviceuser->status ? 'checked' : '' }} />
                                        <div class="swap-on text-white bg-green-400 font-bold ring-1 ring-green-400 px-2 rounded-full">Done</div>
                                        <div class="swap-off text-white bg-red-400 font-bold ring-1 ring-red-400 px-2 rounded-full">Not Done</div>
                                    </label>
                                    </td>
                                    <td>
                                        <div class="flex gap-2 justify-center">
                                            <a href="{{ route('service-edit', $serviceuser->id) }}" class="btn btn-sm btn-info text-white hover:btn-info-focus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                แก้ไข
                                            </a>
                                            <a href="{{ route('service-destroy', $serviceuser->id) }}" class="btn btn-sm btn-error text-white hover:btn-error-focus" onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบข้อมูลนี้?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a2 2 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                ลบ
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="lg:hidden p-4 space-y-4">
                        @foreach ($serviceusers as $serviceuser)
                        <div class="card bg-white border border-gray-200 shadow-md">
                            <div class="card-body p-4">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-bold text-gray-800">{{$serviceuser->name}}</h3>
                                    <div class="badge badge-info badge-sm">ID: {{$serviceuser->id}}</div>
                                </div>
                                
                                <div class="space-y-2 text-sm">
                                    <div class="flex">
                                        <span class="font-medium text-gray-600 w-20">รายการ:</span>
                                        <span class="text-gray-800">{{$serviceuser->itemrepair}}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="font-medium text-gray-600 w-20">สถานที่:</span>
                                        <span class="text-gray-800">{{$serviceuser->location}}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="font-medium text-gray-600 w-20">กำหนด:</span>
                                        <span class="badge badge-outline badge-info badge-sm">{{$serviceuser->date}}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="font-medium text-gray-600 w-20">แจ้งเมื่อ:</span>
                                        <span class="badge badge-outline badge-secondary badge-sm">{{\Carbon\Carbon::parse($serviceuser->created_at)->format('Y-m-d')}}</span>
                                    </div>
                                    <div class="flex">
                                    <span class="font-medium text-gray-600 w-20">สถานะงาน:</span>
                                    <label class="swap">
                                        <input type="checkbox" class="toggle-active" data-id="{{ $serviceuser->id }}" {{ $serviceuser->status ? 'checked' : '' }} />
                                        <div class="swap-on text-white bg-green-400 text-[12px] ring-1 ring-green-400 px-2 rounded-full">Done</div>
                                        <div class="swap-off text-white bg-red-400 text-[12px] ring-1 ring-red-400 px-2 rounded-full">Not Done</div>
                                    </label>
                                    </div>
                                    <div class="mt-2">
                                        <span class="font-medium text-gray-600">รายละเอียด:</span>
                                        <p class="text-gray-700 text-xs mt-1 bg-gray-50 p-2 rounded">{{$serviceuser->detailrepair}}</p>
                                    </div>
                                </div>
                                
                                <div class="flex gap-2 mt-4">
                                    <a href="{{ route('service-edit', $serviceuser->id) }}" class="btn btn-sm btn-info text-white flex-1">
                                        แก้ไข
                                    </a>
                                    <a href="{{ route('service-destroy', $serviceuser->id) }}" class="btn btn-sm btn-error text-white flex-1" onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบข้อมูลนี้?')">
                                        ลบ
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Add New Button -->
        <div class="fixed bottom-6 right-6">
            <button class="btn btn-circle btn-lg btn-primary shadow-2xl hover:shadow-blue-500/25 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </button>
        </div>
    </div>
</div>

{{-- Success Modal --}}
@if(session('success'))
<dialog id="success_modal" class="modal">
    <div class="modal-box border border-green-200 bg-white">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-lg text-green-700">ดำเนินการสำเร็จ!</h3>
                <p class="text-sm text-gray-600">{{ session('success') }}</p>
            </div>
        </div>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn btn-success text-white">ตกลง</button>
            </form>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
@endif

<script>
console.log("JS Script loaded!");
document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM Content Loaded");
    
    // จัดการ Modal ถ้ามี
    @if(session('success'))
    const modal = document.getElementById('success_modal');
    if (modal) {
        console.log("Opening success modal");
        modal.showModal();
    }
    @endif

    // เอา CSRF Token
    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfTokenMeta) {
        console.error('ไม่มี meta csrf-token');
        return;
    }
    const csrfToken = csrfTokenMeta.getAttribute('content');

    // หาทุก toggle
    const toggles = document.querySelectorAll('.toggle-active');

    toggles.forEach((toggle, index) => {
        
        toggle.addEventListener('change', function() {
            console.log('Toggle ถูกกด! ID:', this.dataset.id, 'Status:', this.checked);
            const id = this.dataset.id;
            const status = this.checked ? 1 : 0;
            const input = this;

            // แสดงการโหลด (optional)
            input.disabled = true;

            fetch(`/service/toggle/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Success response:', data);
                if (!data.success) {
                    console.error('เกิดข้อผิดพลาดจากเซิร์ฟเวอร์:', data.message || 'Unknown error');
                    input.checked = !input.checked; // กลับ toggle ถ้าผิดพลาด
                } else {
                    console.log('อัพเดทสถานะสำเร็จ! New status:', data.new_status);
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('เกิดข้อผิดพลาด: ' + error.message);
                input.checked = !input.checked; // กลับ toggle ถ้าผิดพลาด
            })
            .finally(() => {
                input.disabled = false;
            });
        });
    });
});
</script>
@endsection