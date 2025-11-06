@extends('layout')
@section('title')
Services Form Edit
@endsection
{{-- AOS Animation --}}
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
{{-- Flatpickr DatePicker --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
  /* Custom Flatpickr Theme */
  .flatpickr-calendar {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 16px;
    border: 1px solid rgba(59, 130, 246, 0.2);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    font-family: 'Inter', sans-serif;
  }
  
  .flatpickr-day:hover {
    background: linear-gradient(135deg, #3b82f6, #6366f1);
    color: white;
    transform: scale(1.05);
    transition: all 0.2s ease;
  }
  
  .flatpickr-day.selected {
    background: linear-gradient(135deg, #1d4ed8, #4338ca);
    color: white;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
  }

  /* Custom Gradient Text */
  .gradient-text {
    background: linear-gradient(135deg, #3b82f6, #6366f1, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  /* Glass Effect */
  .glass-effect {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
  }

  /* Form Field Animation */
  .form-field {
    transition: all 0.3s ease;
  }
  
  .form-field:focus-within {
    transform: translateY(-2px);
    box-shadow: 0 20px 40px rgba(59, 130, 246, 0.15);
  }

  /* Success Animation */
  @keyframes successPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
  }
  
  .success-animate {
    animation: successPulse 0.6s ease;
  }
</style>
@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-12">
  
  <!-- Background Decorations -->
  <div class="fixed inset-0 pointer-events-none overflow-hidden">
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-200/30 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-purple-200/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s"></div>
    <div class="absolute top-3/4 left-1/2 w-64 h-64 bg-indigo-200/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 4s"></div>
  </div>

  <div class="container mx-auto px-4 relative z-10">
    
    <!-- Header Section -->
    <div class="text-center mb-12" data-aos="fade-down" data-aos-duration="1000">
      <div class="inline-flex items-center gap-3 mb-4">
        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg">
          <i class="fas fa-tools text-white text-xl"></i>
        </div>
        <h1 class="text-5xl lg:text-6xl font-bold gradient-text">
          Services Form Edit
        </h1>
        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-full flex items-center justify-center shadow-lg">
          <i class="fas fa-clipboard-list text-white text-xl"></i>
        </div>
      </div>
      <p class="text-slate-600 text-lg font-medium">แก้ไขข้อมูลการซ่อมบำรุง</p>
      <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mx-auto mt-4"></div>
    </div>

    <!-- Main Form Card -->
    <div class="max-w-4xl mx-auto">
      <div class="card bg-white/80 glass-effect shadow-2xl" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
        
        <div class="card-body p-8 lg:p-12">
          
          <form method="POST" action="{{ route('service-store') }}" class="space-y-8">
            @csrf
            
            <!-- Name Field -->
            <div class="form-control form-field" data-aos="fade-right" data-aos-delay="300">
              <label class="label">
                <span class="label-text text-lg font-semibold text-slate-700 flex items-center gap-2">
                  <i class="fas fa-user text-blue-500"></i>
                  ชื่อผู้แจ้ง
                </span>
              </label>
              <input 
                type="text" 
                name="name" 
                value="{{ old('name', $user->name) }}"
                placeholder="โปรดระบุชื่อของคุณ" 
                class="input input-bordered input-lg w-full bg-white/80 backdrop-blur focus:bg-white transition-all duration-300 border-slate-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-100" 
              />
              @error('name')
                <label class="label">
                  <span class="label-text-alt text-error flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                  </span>
                </label>
              @enderror
            </div>

            <!-- Item to Repair Field -->
            <div class="form-control form-field" data-aos="fade-left" data-aos-delay="400">
              <label class="label">
                <span class="label-text text-lg font-semibold text-slate-700 flex items-center gap-2">
                  <i class="fas fa-wrench text-green-500"></i>
                  สิ่งที่ต้องการซ่อม
                </span>
              </label>
              <input 
                type="text" 
                name="itemrepair" 
                value="{{ old('name', $user->itemrepair) }}"
                placeholder="เช่น คอมพิวเตอร์, เครื่องปริ้นเตอร์, โปรเจคเตอร์" 
                class="input input-bordered input-lg w-full bg-white/80 backdrop-blur focus:bg-white transition-all duration-300 border-slate-200 focus:border-green-400 focus:ring-4 focus:ring-green-100" 
              />
              @error('itemrepair')
                <label class="label">
                  <span class="label-text-alt text-error flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                  </span>
                </label>
              @enderror
            </div>

            <!-- Detail Field -->
            <div class="form-control form-field" data-aos="fade-right" data-aos-delay="500">
              <label class="label">
                <span class="label-text text-lg font-semibold text-slate-700 flex items-center gap-2">
                  <i class="fas fa-clipboard-list text-purple-500"></i>
                  รายละเอียดอาการเสีย
                </span>
              </label>
              <textarea 
                name="detailrepair" 
                placeholder="โปรดอธิบายอาการเสียอย่างละเอียด เช่น จอไม่ติด, เปิดไม่ติด, มีเสียงแปลกๆ, ช้าผิดปกติ" 
                class="textarea textarea-bordered textarea-lg w-full h-32 bg-white/80 backdrop-blur focus:bg-white transition-all duration-300 border-slate-200 focus:border-purple-400 focus:ring-4 focus:ring-purple-100 resize-none"
              >{{ old('name', $user->detailrepair) }}</textarea>
              @error('detailrepair')
                <label class="label">
                  <span class="label-text-alt text-error flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                  </span>
                </label>
              @enderror
            </div>

            <!-- Location Field -->
            <div class="form-control form-field" data-aos="fade-left" data-aos-delay="600">
              <label class="label">
                <span class="label-text text-lg font-semibold text-slate-700 flex items-center gap-2">
                  <i class="fas fa-map-marker-alt text-red-500"></i>
                  สถานที่
                </span>
              </label>
              <input 
                type="text" 
                name="location" 
                value="{{ old('name', $user->location) }}"
                placeholder="เช่น ห้องคอมพิวเตอร์ 2, ห้องประชุม A, อาคาร 3 ชั้น 2" 
                class="input input-bordered input-lg w-full bg-white/80 backdrop-blur focus:bg-white transition-all duration-300 border-slate-200 focus:border-red-400 focus:ring-4 focus:ring-red-100" 
              />
              @error('location')
                <label class="label">
                  <span class="label-text-alt text-error flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                  </span>
                </label>
              @enderror
            </div>

            <!-- Date Field -->
            <div class="form-control form-field" data-aos="fade-right" data-aos-delay="700">
              <label class="label">
                <span class="label-text text-lg font-semibold text-slate-700 flex items-center gap-2">
                  <i class="fas fa-calendar-alt text-orange-500"></i>
                  กำหนดส่งงานก่อน
                </span>
              </label>
              <input 
                type="text" 
                id="datepicker" 
                name="date" 
                value="{{ old('name', $user->date) }}"
                placeholder="คลิกเพื่อเลือกวันที่" 
                class="input input-bordered input-lg w-full bg-white/80 backdrop-blur focus:bg-white transition-all duration-300 border-slate-200 focus:border-orange-400 focus:ring-4 focus:ring-orange-100 cursor-pointer" 
                readonly
              />
              @error('date')
                <label class="label">
                  <span class="label-text-alt text-error flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                  </span>
                </label>
              @enderror
            </div>

            <!-- Submit Button -->
            <div class="form-control pt-4" data-aos="fade-up" data-aos-delay="800">
              <button 
                type="submit" 
                class="btn btn-lg bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 hover:from-blue-600 hover:via-purple-600 hover:to-pink-600 text-white border-0 shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 group"
              >
                <i class="fas fa-paper-plane group-hover:rotate-12 transition-transform duration-300"></i>
                <span class="font-bold text-lg">ส่งคำขอซ่อม</span>
                <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Success Modal --}}
@if(session('success'))
<dialog id="success_modal" class="modal">
  <div class="modal-box bg-gradient-to-br from-green-50 to-emerald-50 border-2 border-green-200 success-animate">
    <div class="text-center space-y-4">
      <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full flex items-center justify-center mx-auto shadow-lg">
        <i class="fas fa-check text-white text-2xl"></i>
      </div>
      <h3 class="font-bold text-2xl text-green-700">ส่งคำขอสำเร็จ! 🎉</h3>
      <p class="text-green-600 text-lg">{{ session('success') }}</p>
      <div class="flex items-center justify-center gap-2 text-green-500">
        <i class="fas fa-info-circle"></i>
        <span class="text-sm">เราจะติดต่อกลับไปในเร็วๆ นี้</span>
      </div>
    </div>
    <div class="modal-action justify-center">
      <form method="dialog">
        <button class="btn btn-success btn-lg shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
          <i class="fas fa-thumbs-up"></i>
          ตกลง
        </button>
      </form>
    </div>
  </div>
</dialog>

<script>
  window.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('success_modal');
    if(modal) {
      modal.showModal();
      // Add confetti effect or celebration animation here if needed
    }
  });
</script>
@endif

<!-- Scripts -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
  // Initialize AOS
  AOS.init({
    duration: 1000,
    easing: 'ease-out-cubic',
    once: true
  });

  // Initialize Flatpickr
  flatpickr("#datepicker", {
    dateFormat: "Y-m-d",
    minDate: "today",
    locale: {
      firstDayOfWeek: 1,
      weekdays: {
        shorthand: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
        longhand: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์']
      },
      months: {
        shorthand: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
        longhand: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม']
      }
    },
    onChange: function(selectedDates, dateStr, instance) {
      // Add animation when date is selected
      instance.input.classList.add('animate-pulse');
      setTimeout(() => {
        instance.input.classList.remove('animate-pulse');
      }, 500);
    }
  });

  // Add form interaction effects
  document.querySelectorAll('.form-field input, .form-field textarea').forEach(field => {
    field.addEventListener('focus', function() {
      this.closest('.form-field').classList.add('scale-[1.02]');
    });
    
    field.addEventListener('blur', function() {
      this.closest('.form-field').classList.remove('scale-[1.02]');
    });
  });

  // Form submission animation
  document.querySelector('form').addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.innerHTML = '<i class="fas fa-spinner animate-spin"></i> <span>กำลังส่ง...</span>';
    submitBtn.disabled = true;
  });
</script>
@endsection